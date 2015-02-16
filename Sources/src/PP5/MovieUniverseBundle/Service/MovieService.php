<?php

namespace PP5\MovieUniverseBundle\Service;

use Doctrine\Common\Collections\ArrayCollection;
use PP5\MovieUniverseBundle\Repository\MovieRepository;

class MovieService {

    protected $movieRepository;

    public function __construct(MovieRepository $repository)
    {
        $this->movieRepository = $repository;
    }

    public function getTop10ReviewedMovies()
    {
        $orderedReviewedMoviesId = $this->movieRepository->findMoviesWithReviewsId();
        $top10MostReviewedMovies = new ArrayCollection();

        foreach ($orderedReviewedMoviesId as $movieId)
        {
            $movie = $this->movieRepository->findMovie($movieId);
            $top10MostReviewedMovies->add($movie);
        }

        return $top10MostReviewedMovies->toArray();
    }

    public function getAvailableMovies()
    {
        $availableMovies = $this->movieRepository->findAllAvailableMovies();
        return $availableMovies;
    }

    public function getGenres()
    {
        $genres = $this->movieRepository->findGenres();
        return $genres;
    }

}