<?php

namespace PP5\MovieUniverseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class MovieController extends Controller
{
    /**
     * @Route("/movie/{slug}", requirements={
	*		"page": "\d+"
	 * })
     * @Template()
     */
    public function viewAction($slug)
    {
        $movieService = $this->get('pp5_movie_universe.movie_service');

        $movie = $movieService->getMovie($slug);

        return $this->render('PP5MovieUniverseBundle:Movie:movie.html.twig',
            array(
                'movie' => $movie,
            ));
    }
}