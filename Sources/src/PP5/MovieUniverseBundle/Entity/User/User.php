<?php

namespace PP5\MovieUniverseBundle\Entity\User;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="mu_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="Proszę wpisać swoje imię.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *  min=3,
     *  max=100,
     *  minMessage="Imię jest za krótkie.",
     *  maxMessage="Imię jest za długie.",
     *  groups={"Registration","Profile"}
     * )
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="Proszę wpisać swoje nazwisko.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *  min=2,
     *  max=100,
     *  minMessage="Nazwisko jest za krótkie.",
     *  maxMessage="Nazwisko jest za długie.",
     *  groups={"Registration", "Profile"}
     * )
     */
    protected $surname;

    /**
     * @ORM\OneToMany(targetEntity="PP5\MovieUniverseBundle\Entity\Order\Order", mappedBy="user")
     */
    protected $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getOrders()
    {
        return $this->orders;
    }

    /**
     * @param mixed $orders
     */
    public function setOrders($orders)
    {
        $this->orders = $orders;
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
     * Set name
     *
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     * @return User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Add orders
     *
     * @param \PP5\MovieUniverseBundle\Entity\Order\Order $orders
     * @return User
     */
    public function addOrder(\PP5\MovieUniverseBundle\Entity\Order\Order $orders)
    {
        $this->orders[] = $orders;

        return $this;
    }

    /**
     * Remove orders
     *
     * @param \PP5\MovieUniverseBundle\Entity\Order\Order $orders
     */
    public function removeOrder(\PP5\MovieUniverseBundle\Entity\Order\Order $orders)
    {
        $this->orders->removeElement($orders);
    }
}
