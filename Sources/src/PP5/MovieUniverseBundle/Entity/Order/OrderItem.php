<?php

namespace PP5\MovieUniverseBundle\Entity\Order;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PP5\MovieUniverseBundle\Repository\OrderItemRepository")
 * @ORM\Table()
 */
class OrderItem {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="PP5\MovieUniverseBundle\Entity\Movie\Movie")
     * @ORM\JoinColumn(name="movie_id", referencedColumnName="id")
     */
    protected $movie;

    /**
     * @ORM\ManyToOne(targetEntity="PP5\MovieUniverseBundle\Entity\Order\Order", inversedBy="orderItems")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id")
     */
    protected $order;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    protected $price;

    public function equals(OrderItem $otherOrderItem)
    {
        return ($this->movie === $otherOrderItem->getMovie()
            && $this->order === $otherOrderItem->getOrder());
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return OrderItem
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set movie
     *
     * @param \PP5\MovieUniverseBundle\Entity\Movie\Movie $movie
     * @return OrderItem
     */
    public function setMovie(\PP5\MovieUniverseBundle\Entity\Movie\Movie $movie = null)
    {
        $this->movie = $movie;

        return $this;
    }

    /**
     * Get movie
     *
     * @return \PP5\MovieUniverseBundle\Entity\Movie\Movie 
     */
    public function getMovie()
    {
        return $this->movie;
    }

    /**
     * Set order
     *
     * @param \PP5\MovieUniverseBundle\Entity\Order\Order $order
     * @return OrderItem
     */
    public function setOrder(\PP5\MovieUniverseBundle\Entity\Order\Order $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \PP5\MovieUniverseBundle\Entity\Order\Order 
     */
    public function getOrder()
    {
        return $this->order;
    }
}
