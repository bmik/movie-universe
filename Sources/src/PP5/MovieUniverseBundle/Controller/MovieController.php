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

    /**
     * @Route("/movie/{slug}/order_add", name="order.add_item")
     */
    public function addMovieToCartAction(Request $request, $slug)
    {
        $orderService = $this->get('pp5_movie_universe.order.service');
        $movieService = $this->get('pp5_movie_universe.movie_service');
        $userService = $this->get('pp5_movie_universe.user.service');

        $url = $request->headers->get('referer');
        $response = new RedirectResponse($url);

        $isLoggedUser = $this->container->get('security.context')->isGranted("ROLE_USER");
        $loggedUserName = $this->container->get('security.token_storage')->getToken()->getUsername();
        $loggedUser = $userService->getLoggedUser($loggedUserName);

        $orderCookie = $request->cookies->get('ORDERID');

        $order = $orderService->getOrder($orderCookie, $loggedUser);
        $movie = $movieService->getMovie($slug);

        $orderService->addMovie($order, $movie);

        if (!$orderCookie && !$isLoggedUser) {
            $orderCookie = new Cookie('ORDERID', $order->getId(), (time() + (3600 * 24 * 3)));
            $response->headers->setCookie($orderCookie);
        }

        if ($orderCookie && $isLoggedUser) {
            $response->headers->removeCookie('ORDERID');
        }

        $response->sendHeaders();

        return $response;
    }
}
