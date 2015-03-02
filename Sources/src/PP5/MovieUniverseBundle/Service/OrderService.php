<?php

namespace PP5\MovieUniverseBundle\Service;

use Doctrine\ORM\EntityManager;
use PP5\MovieUniverseBundle\Entity\Movie\Movie;
use PP5\MovieUniverseBundle\Entity\Order\Order;
use PP5\MovieUniverseBundle\Entity\Order\OrderItem;
use PP5\MovieUniverseBundle\Entity\User\User;
use PP5\MovieUniverseBundle\Enum\OrderStatus;
use PP5\MovieUniverseBundle\Handler\OrderNumberHandler;

class OrderService {

    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getOrderByID($orderId)
    {
        $orderRepository = $this->entityManager->getRepository('PP5MovieUniverseBundle:Order\Order');
        $order = $orderRepository->find($orderId);

        return $order;
    }

    public function getOrderByUser(User $user = null)
    {
        $orderRepository = $this->entityManager->getRepository('PP5MovieUniverseBundle:Order\Order');
        $order = $orderRepository->findOneBy(array("user" => $user, "status" => OrderStatus::ORDER_STATUS_PENDING));

        return $order;
    }

    public function getOrderWithItems($orderId)
    {
        $orderRepository = $this->entityManager->getRepository('PP5MovieUniverseBundle:Order\Order');
        $fullOrder = $orderRepository->getOrderWithItems($orderId);

        return $fullOrder;
    }

    public function addMovie(Order $order, Movie $movie)
    {
        $orderItemRepository = $this->entityManager->getRepository('PP5MovieUniverseBundle:Order\OrderItem');

        $orderItem = $orderItemRepository->findOneBy(array("movie" => $movie, "order" => $order));

        if (!$orderItem)
        {
            $orderItem = new OrderItem();
            $orderItem->setPrice($movie->getPrice());
            $orderItem->setMovie($movie);
            $orderItem->setOrder($order);

            $order->setUpdatedAt(new \DateTime());

            $this->entityManager->persist($orderItem);
        } else
        {
            $orderItem->setPrice($movie->getPrice());
            $this->entityManager->merge($orderItem);
        }

        $this->entityManager->flush();

        return true;
    }

    public function removeMovie($orderId, $movieId)
    {
        $orderItemRepository = $this->entityManager->getRepository('PP5MovieUniverseBundle:Order\OrderItem');
        $orderRepository = $this->entityManager->getRepository('PP5MovieUniverseBundle:Order\Order');
        $movieRepository = $this->entityManager->getRepository('PP5MovieUniverseBundle:Movie\Movie');

        $movie = $movieRepository->find($movieId);
        $order = $orderRepository->find($orderId);

        $orderItem = $orderItemRepository->findOneBy(array("movie" => $movie, "order" => $order));

        if ($orderItem)
        {
            $this->entityManager->remove($orderItem);
        }

        $this->entityManager->flush();

        return true;
    }

    public function clear($orderId)
    {
        $orderRepository = $this->entityManager->getRepository('PP5MovieUniverseBundle:Order\Order');
        $orderItemRepository = $this->entityManager->getRepository('PP5MovieUniverseBundle:Order\OrderItem');

        $order = $orderRepository->find($orderId);

        if ($order)
        {
            $orderItemRepository->removeOrderItemsForOrder($order);
        }

        return true;
    }

    public function getQuantity($orderId)
    {
        $orderRepository = $this->entityManager->getRepository('PP5MovieUniverseBundle:Order\Order');

        $order = $orderRepository->getOrderWithItems($orderId);

        if ($order) {
            $quantity = $order->getOrderItems()->count();
        } else {
            $quantity = 0;
        }
        return $quantity;
    }

    public function getTotal($orderId)
    {
        $orderRepository = $this->entityManager->getRepository('PP5MovieUniverseBundle:Order\Order');

        $order = $orderRepository->getOrderWithItems($orderId);

        $sum = 0;

        foreach ($order->getOrderItems() as $orderItem) {
            $sum += $orderItem->getPrice();
        }

        return $sum;
    }

    public function prepareForPayment($orderId)
    {
        $order = $this->getOrderByID($orderId);

        $status = $this->getStatus(OrderStatus::ORDER_STATUS_TO_PAY);
        $number = OrderNumberHandler::generateNumber($orderId);

        $order->setStatus($status);
        $order->setNumber($number);

        $this->entityManager->flush();
    }

    public function completeOrder($orderId)
    {
        $order = $this->getOrderByID($orderId);

        $status = $this->getStatus(OrderStatus::ORDER_STATUS_COMPLETED);
        $order->setStatus($status);

        $this->entityManager->flush();
    }

    public function createNewOrder(User $user = null)
    {
        $order = new Order();
        $status = $this->getStatus(OrderStatus::ORDER_STATUS_PENDING);
        $order->setStatus($status);
        if ($user != null) {
            $order->setUser($user);
        }
        $order->setCreatedAt(new \DateTime());

        $this->entityManager->persist($order);
        $this->entityManager->flush();

        return $order;
    }

    /*private function handleOrderExists($cookie, User $loggedUser = null)
    {
        $orderRepository = $this->entityManager->getRepository('PP5MovieUniverseBundle:Order\Order');

        if ($loggedUser != null)
        {
            $order = $orderRepository->findOneBy(array("user" => $loggedUser, "status" => 1));
            if ($order == null)
            {
                $order = $this->createNewOrder($loggedUser);
            }

        }
        else if ($cookie)
        {
            $order = $orderRepository->find($cookie);
        } else
        {
            $order = $this->createNewOrder();
        }

        return $order;
    }*/

    private function getStatus($statusId)
    {
        $statusRepository = $this->entityManager->getRepository('PP5MovieUniverseBundle:Order\OrderStatus');
        $status = $statusRepository->find($statusId);

        return $status;
    }

} 