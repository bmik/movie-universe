<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * MovieRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MovieRepository extends EntityRepository
{

    public function findTop10MostReviewedMovies()
    {
        $limit = 10;
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select('m, count(m.reviews) as reviewsCount')
           ->from('AppBundle:Movie\Movie', 'm')
           ->addOrderBy('reviewsCount', 'DESC')
           ->setMaxResults($limit);
        return $qb->getQuery()->getResult();
    }

    public function findTop10MostOrderedMovies()
    {

    }

}
