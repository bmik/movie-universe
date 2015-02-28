<?php

namespace PP5\MovieUniverseBundle\Entity\Order;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PP5\MovieUniverseBundle\Repository\OrderRepository")
 * @ORM\Table(name="mu_order")
 */
class Order
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=12, nullable=true)
     */
    protected $number;

    /**
     * @ORM\ManyToOne(targetEntity="PP5\MovieUniverseBundle\Entity\User\User", inversedBy="orders")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\OneToMany(targetEntity="OrderItem", mappedBy="order")
     */
    protected $orderItems;

    /**
     * @ORM\ManyToOne(targetEntity="OrderStatus")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     */
    protected $status;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * @ORM\Column(name="completed_at", type="datetime", nullable=true)
     */
    protected $completedAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    protected $updatedAt;

    /**
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    protected $deletedAt;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->orderItems = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set number
     *
     * @param string $number
     * @return Order
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Order
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set completedAt
     *
     * @param \DateTime $completedAt
     * @return Order
     */
    public function setCompletedAt($completedAt)
    {
        $this->completedAt = $completedAt;

        return $this;
    }

    /**
     * Get completedAt
     *
     * @return \DateTime 
     */
    public function getCompletedAt()
    {
        return $this->completedAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Order
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     * @return Order
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime 
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Set user
     *
     * @param \PP5\MovieUniverseBundle\Entity\User\User $user
     * @return Order
     */
    public function setUser(\PP5\MovieUniverseBundle\Entity\User\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \PP5\MovieUniverseBundle\Entity\User\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add orderItems
     *
     * @param \PP5\MovieUniverseBundle\Entity\Order\OrderItem $orderItems
     * @return Order
     */
    public function addOrderItem(\PP5\MovieUniverseBundle\Entity\Order\OrderItem $orderItems)
    {
        $this->orderItems[] = $orderItems;

        return $this;
    }

    /**
     * Remove orderItems
     *
     * @param \PP5\MovieUniverseBundle\Entity\Order\OrderItem $orderItems
     */
    public function removeOrderItem(\PP5\MovieUniverseBundle\Entity\Order\OrderItem $orderItems)
    {
        $this->orderItems->removeElement($orderItems);
    }

    /**
     * Get orderItems
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrderItems()
    {
        return $this->orderItems;
    }

    /**
     * Set status
     *
     * @param \PP5\MovieUniverseBundle\Entity\Order\OrderStatus $status
     * @return Order
     */
    public function setStatus(\PP5\MovieUniverseBundle\Entity\Order\OrderStatus $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \PP5\MovieUniverseBundle\Entity\Order\OrderStatus 
     */
    public function getStatus()
    {
        return $this->status;
    }
}
