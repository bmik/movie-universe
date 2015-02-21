<?php

namespace PP5\MovieUniverseBundle\Entity\Order;

use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Cart\Model\CartItem;

/**
 * @ORM\Entity()
 * @ORM\Table()
 */
class OrderItem extends CartItem {

    /**
     * @ORM\ManyToOne(targetEntity="PP5\MovieUniverseBundle\Entity\Movie\Movie")
     * @ORM\JoinColumn(name="movie_id", referencedColumnName="id")
     */
    protected $movie;

    /**
     * @return mixed
     */
    public function getMovie()
    {
        return $this->movie;
    }

    /**
     * @param mixed $movie
     */
    public function setMovie($movie)
    {
        $this->movie = $movie;
    }

}