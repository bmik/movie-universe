<?php

namespace PP5\MovieUniverseBundle\Repository;

use Doctrine\ORM\EntityRepository;

class OrderItemRepository extends EntityRepository {

    public function removeOrderItemsForOrder($order)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb ->delete('PP5MovieUniverseBundle:Order\OrderItem', 'oi')
            ->where('oi.order = ?1')
            ->setParameter(1, $order);

        $qb->getQuery()->execute();
    }

} 