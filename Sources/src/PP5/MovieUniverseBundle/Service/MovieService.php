<?php

namespace PP5\MovieUniverseBundle\Service;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use PP5\MovieUniverseBundle\Repository\MovieRepository;

class MovieService {

    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
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

        foreach ($orderedReviewedMoviesId as $movieId)
        {
            $movie = $movieRepository->findMovie($movieId);
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

}