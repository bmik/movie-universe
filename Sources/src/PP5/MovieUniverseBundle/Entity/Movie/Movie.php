<?php

namespace PP5\MovieUniverseBundle\Entity\Movie;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="PP5\MovieUniverseBundle\Repository\MovieRepository")
 * @ORM\Table()
 */
class Movie {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $title;

    /**
     * @ORM\ManyToOne(targetEntity="Genre", inversedBy="movies")
     * @ORM\JoinColumn(name="genre_id", referencedColumnName="id")
     */
    protected $genre;

    /**
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    protected $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $pathToCover;

    /**
     * @ORM\OneToMany(targetEntity="Review", mappedBy="movie")
     */
    protected $reviews;

    /**
     * @ORM\ManyToMany(targetEntity="Actor", inversedBy="movies")
     * @ORM\JoinTable(name="movies_actors")
     **/
    protected $actors;

    public function __construct()
    {
        $this->reviews = new ArrayCollection();
        $this->actors = new ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return Movie
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Movie
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return Movie
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
     * Set pathToCover
     *
     * @param string $pathToCover
     * @return Movie
     */
    public function setPathToCover($pathToCover)
    {
        $this->pathToCover = $pathToCover;

        return $this;
    }

    /**
     * Get pathToCover
     *
     * @return string 
     */
    public function getPathToCover()
    {
        return $this->pathToCover;
    }

    /**
     * Set genre
     *
     * @param \PP5\MovieUniverseBundle\Entity\Movie\Genre $genre
     * @return Movie
     */
    public function setGenre(\PP5\MovieUniverseBundle\Entity\Movie\Genre $genre = null)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return \PP5\MovieUniverseBundle\Entity\Movie\Genre 
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Add reviews
     *
     * @param \PP5\MovieUniverseBundle\Entity\Movie\Review $reviews
     * @return Movie
     */
    public function addReview(\PP5\MovieUniverseBundle\Entity\Movie\Review $reviews)
    {
        $this->reviews[] = $reviews;

        return $this;
    }

    /**
     * Remove reviews
     *
     * @param \PP5\MovieUniverseBundle\Entity\Movie\Review $reviews
     */
    public function removeReview(\PP5\MovieUniverseBundle\Entity\Movie\Review $reviews)
    {
        $this->reviews->removeElement($reviews);
    }

    /**
     * Get reviews
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * Add actors
     *
     * @param \PP5\MovieUniverseBundle\Entity\Movie\Actor $actors
     * @return Movie
     */
    public function addActor(\PP5\MovieUniverseBundle\Entity\Movie\Actor $actors)
    {
        $this->actors[] = $actors;

        return $this;
    }

    /**
     * Remove actors
     *
     * @param \PP5\MovieUniverseBundle\Entity\Movie\Actor $actors
     */
    public function removeActor(\PP5\MovieUniverseBundle\Entity\Movie\Actor $actors)
    {
        $this->actors->removeElement($actors);
    }

    /**
     * Get actors
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getActors()
    {
        return $this->actors;
    }
}
