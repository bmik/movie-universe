<?php

namespace PP5\MovieUniverseBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class OrderCartController extends Controller {

    /**
     * @Route("/cart", name="cart")
     */
    public function indexAction(Request $request)
    {
        $orderService = $this->get('pp5_movie_universe.order.service');
        $userService = $this->get('pp5_movie_universe.user.service');

        $orderCookie = $request->cookies->get('ORDERID');
        $loggedUserName = $this->container->get('security.token_storage')->getToken()->getUsername();
        $loggedUser = $userService->getLoggedUser($loggedUserName);

        $order = $orderService->getOrderWithItems($orderCookie, $loggedUser);

        return $this->render('@PP5MovieUniverse/OrderCart/cart.html.twig',
            array("order" => $order));
    }

    /**
     * @Route("/cart/add/{slug}", name="cart.add_item")
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

		$this->get('session')->getFlashBag()->set('notice', 'Film pomyślnie dodany do koszyka!');
		
        return $response;
    }

	/**
     * @Route("/cart/remove?orderId={orderId}&movieId={movieId}", name="cart.remove_item")
     */
	public function removeMovieFromCartAction($orderId, $movieId)
	{		
		$orderService = $this->get('pp5_movie_universe.order.service');
		
		$orderService->removeMovie($orderId, $movieId);
		
		$this->get('session')->getFlashBag()->set('notice', 'Film usunięty z koszyka!');
		 
		return $this->redirect($this->generateUrl('cart'));
		
	}
	
} 