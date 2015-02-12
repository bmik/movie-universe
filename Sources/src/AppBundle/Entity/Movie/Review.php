<?php

namespace AppBundle\Entity\Movie;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class Review {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="text")
     */
    protected $reviewContent;

    /**
     * @ORM\ManyToOne(targetEntity="Movie", inversedBy="reviews")
     * @ORM\JoinColumn(name="movie_id", referencedColumnName="id")
     */
    protected $movie;


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
     * Set reviewContent
     *
     * @param string $reviewContent
     * @return Review
     */
    public function setReviewContent($reviewContent)
    {
        $this->reviewContent = $reviewContent;

        return $this;
    }

    /**
     * Get reviewContent
     *
     * @return string 
     */
    public function getReviewContent()
    {
        return $this->reviewContent;
    }

    /**
     * Set movie
     *
     * @param \AppBundle\Entity\Movie\Movie $movie
     * @return Review
     */
    public function setMovie(\AppBundle\Entity\Movie\Movie $movie = null)
    {
        $this->movie = $movie;

        return $this;
    }

    /**
     * Get movie
     *
     * @return \AppBundle\Entity\Movie\Movie 
     */
    public function getMovie()
    {
        return $this->movie;
    }
}
