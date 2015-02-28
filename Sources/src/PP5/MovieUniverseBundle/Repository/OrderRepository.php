<?php

namespace PP5\MovieUniverseBundle\Repository;

use Doctrine\ORM\EntityRepository;

class OrderRepository extends EntityRepository {

    public function getOrderWithItems($orderId)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb ->select('o', 's', 'i')
            ->from('PP5MovieUniverseBundle:Order\Order', 'o')
            ->join('o.orderItems', 'i')
            ->join('o.status', 's')
            ->where('o.id = :id')
            ->setParameter('id', (int) $orderId);

        return $qb->getQuery()->getOneOrNullResult();
    }

}