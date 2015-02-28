<?php

namespace PP5\MovieUniverseBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class MovieController extends Controller
{
    /**
     * @Route("/movie/{slug}", name="movie", requirements={
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
