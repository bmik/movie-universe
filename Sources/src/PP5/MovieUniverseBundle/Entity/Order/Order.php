<?php

namespace PP5\MovieUniverseBundle\Entity\Order;

use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Cart\Model\Cart;

/**
 * @ORM\Entity()
 * @ORM\Table(name="mu_order")
 */
class Order extends Cart {

    /**
     * @ORM\ManyToOne(targetEntity="PP5\MovieUniverseBundle\Entity\User\User", inversedBy="orders")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

}