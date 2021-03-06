<?php

namespace PP5\MovieUniverseBundle\Controller;

use PP5\MovieUniverseBundle\Enum\ApplicationConstantName;
use PP5\MovieUniverseBundle\Handler\PaymentProviderURLHandler;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContextInterface;

class OrderCartController extends BaseController {

    /**
     * @Route("/cart", name="cart")
     */
    public function indexAction(Request $request)
    {
        $orderService = $this->get('pp5_movie_universe.order.service');
        $orderId = $request->getSession()->get(ApplicationConstantName::SESSION_ORDER_ID);

        $order = $orderService->getOrderWithItems($orderId);

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
        $userService  = $this->get('pp5_movie_universe.user.service');

        $url = $request->headers->get('referer');
        $response = new RedirectResponse($url);

        $orderId = $request->getSession()->get(ApplicationConstantName::SESSION_ORDER_ID);

        $movie = $movieService->getMovie($slug);

        $user = $userService->getLoggedUser($this->container->get('security.context')->getToken()->getUser());

        if (!$orderId) {
            $order = $orderService->createNewOrder($user);
        } else {
            $order = $orderService->getOrderByID($orderId);
        }

        $orderService->addMovie($order, $movie);

        if (!$orderId && !$user) {
            $orderCookie = new Cookie(ApplicationConstantName::COOKIE_ORDER_ID,
                $order->getId(), (time() + (3600 * 24 * 3)));
            $response->headers->setCookie($orderCookie);
        }

        $response->sendHeaders();

        $this->get('session')->getFlashBag()->set('notice', 'Film dodany do koszyka!');

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
	
	
	/**
     * @Route("/cart/clear?orderId={orderId}", name="cart.clear")
     */
	public function clearCartAction($orderId)
	{
		$orderService = $this->get('pp5_movie_universe.order.service');
		
		$orderService->clear($orderId);
		
		$this->get('session')->getFlashBag()->set('notice', 'Koszyk wyczyszczony!');
		
		return $this->redirect($this->generateUrl('cart'));
	}
	
	/**
     * @Route("/cart/complete/pay?orderId={orderId}", name="cart.completeOrder")
     */
	public function completeOrderAction($orderId)
	{
        $orderService = $this->get('pp5_movie_universe.order.service');
        $order = $orderService->getOrderByID($orderId);
        $total = $orderService->getTotal($orderId);

        $orderService->prepareForPayment($orderId);

        $urlc = $this->generateUrl('cart.complete.handle', array("orderId" => $orderId), true);
        $url = $this->generateUrl('home', array(), true);
        $customerId = $this->container->getParameter('dotpay_id');

        $url = PaymentProviderURLHandler::generateURL($order, $total, $url, $urlc, $customerId);

        return new RedirectResponse($url);
    }


    /**
     * @Route("/cart/complete/handle?orderId={orderId}", name="cart.complete.handle")
     */
    public function handleAction(Request $request, $orderId) {

        $logger = $this->get('monolog.logger.dotpay');
        $logger->info("============= NEW URLC NOTIFICATION ==============");
        $logger->info(var_export($request->request, true));

        $response = $this->get('pp5_movie_universe.payment.service')->handleRequest($request);

        $logger->info(var_export($response, true));

        return new Response("OK");
    }
} 