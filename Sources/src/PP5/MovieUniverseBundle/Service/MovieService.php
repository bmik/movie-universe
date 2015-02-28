<?php

namespace PP5\MovieUniverseBundle\Service;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use PP5\MovieUniverseBundle\Entity\Movie\Review;

class MovieService {

    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getMovie($id)
    {
        $movieRepository = $this->entityManager->getRepository('PP5MovieUniverseBundle:Movie\Movie');
        return $movieRepository->findMovie($id);
    }

    public function getMostOrderedMovies()
    {
        return new ArrayCollection();
    }

    public function getMostReviewedMovies()
    {
        $movieRepository = $this->entityManager->getRepository('PP5MovieUniverseBundle:Movie\Movie');

        $orderedReviewedMoviesId = $movieRepository->findMoviesWithReviewsId();
        $top10MostReviewedMovies = new ArrayCollection();

        foreach ($orderedReviewedMoviesId as $id => $movieId)
        {
            $movie = $movieRepository->findMovie($movieId['id']);
            $top10MostReviewedMovies->add($movie);
        }

        return $top10MostReviewedMovies->toArray();
    }

    public function getAvailableMovies()
    {
        $movieRepository = $this->entityManager->getRepository('PP5MovieUniverseBundle:Movie\Movie');

        $availableMovies = $movieRepository->findAllAvailableMovies();
        return $availableMovies;
    }

    public function getGenres()
    {
        $genreRepository = $this->entityManager->getRepository('PP5MovieUniverseBundle:Movie\Genre');

        $genres = $genreRepository->findAll();
        return $genres;
    }

    public function addReview($movieId, Review $review)
    {
        $movieRepository = $this->entityManager->getRepository('PP5MovieUniverseBundle:Movie\Movie');

        $movie = $movieRepository->find($movieId);

        $review->setMovie($movie);

        $this->entityManager->persist($review);
        $this->entityManager->flush();
    }

}