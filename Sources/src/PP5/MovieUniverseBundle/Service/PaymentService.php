<?php

namespace PP5\MovieUniverseBundle\Service;

use Doctrine\ORM\EntityManager;
use PP5\MovieUniverseBundle\Enum\TransactionStatus;

class PaymentService {

    protected $id;
    protected $pin;
    protected $entityManager;
    protected $orderService;

    public function __construct($id, $pin, EntityManager $entityManager, OrderService $orderService)
    {
        $this->id = $id;
        $this->pin = $pin;
        $this->entityManager = $entityManager;
        $this->orderService = $orderService;
    }

    public function handleRequest($request)
    {
        $hash = $this->calculateHash($request);

        if ($this->isTransactionValid($hash, $request->request->get('md5'), $request->request->get('control'),
            $request->request->get('t_status'))) {

            $orderNumber = $request->request->get('control');
            $order = $this->entityManager->getRepository('PP5MovieUniverseBundle:Order\Order')
                ->findOneBy(['number' => $orderNumber]);

            $this->orderService->completeOrder($order->getId());

            return TransactionStatus::TRANSACTION_OK;

        } else {
            return TransactionStatus::TRANSACTION_ERROR;
        }
    }

    protected function calculateHash($request)
    {
        $hash = sprintf(
            '%s:%s:%s:%s:%s:%s:%s:%s:%s:%s:%s',
            $this->pin,
            $this->id,
            $request->request->get('control'),
            $request->request->get('t_id'),
            $request->request->get('amount'),
            $request->request->get('email'),
            $request->request->get('service'),
            $request->request->get('code'),
            $request->request->get('username'),
            $request->request->get('password'),
            $request->request->get('t_status')
        );

        return md5($hash);
    }

    protected function isTransactionValid($hash, $md5, $control, $status)
    {
        if ($hash != $md5) {
            return false;
        }

        if ($status != TransactionStatus::TRANSACTION_STATUS_OK) {
            return false;
        }

        if (!$this->entityManager->getRepository('PP5MovieUniverseBundle:Order\Order')->findOneBy(['number' => $control])) {
            return false;
        }

        return true;
    }

} 