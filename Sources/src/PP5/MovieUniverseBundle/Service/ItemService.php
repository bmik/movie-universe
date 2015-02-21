<?php

namespace PP5\MovieUniverseBundle\Service;

use Doctrine\ORM\EntityManager;
use Sylius\Component\Cart\Model\CartItemInterface;
use Sylius\Component\Cart\Resolver\ItemResolverInterface;
use Sylius\Component\Cart\Resolver\ItemResolvingException;

class ItemService implements ItemResolverInterface {

    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Returns item that will be added into the cart.
     *
     * @param CartItemInterface $item Empty and clean item object as first argument
     * @param mixed $data Mixed data from which item identifier is extracted
     *
     * @return CartItemInterface
     *
     * @throws ItemResolvingException
     */
    public function resolve(CartItemInterface $item, $request)
    {
        $movieId = $request->query->get('movieId');

        if (!$movieId || !$movie = $this->getMovieRepository()->find($movieId)) {
            throw new ItemResolvingException('Requested movie was not found');
        }

        $item->setMovie($movie);
        $item->setUnitPrice($movie->getPrice());

        return $item;
    }

    public function getMovieRepository()
    {
        return $this->entityManager->getRepository('PP5MovieUniverseBundle:Movie\Movie');
    }

}