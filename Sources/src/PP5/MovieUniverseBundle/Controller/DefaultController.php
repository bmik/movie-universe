<?php

namespace PP5\MovieUniverseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/home", name="home")
     * @Template()
     */
    public function indexAction()
    {
        $movieService = $this->get('pp5_movie_universe.movie_service');
		
        $availableMovies = $movieService->getAvailableMovies();
        $mostOrderedMovies = $movieService->getMostOrderedMovies();
        $mostReviewedMovies = $movieService->getMostReviewedMovies();
        $genres = $movieService->getGenres();
		
        return $this->render('PP5MovieUniverseBundle:Default:index.html.twig',
            array(
                'available_movies' => $availableMovies,
                'most_ordered_movies' => $mostOrderedMovies,
                'most_reviewed_movies' => $mostReviewedMovies,
                'genres' => $genres)
            );
    }
}
