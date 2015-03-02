<?php

namespace PP5\MovieUniverseBundle\Controller;

use PP5\MovieUniverseBundle\Enum\ApplicationConstantName;
use PP5\MovieUniverseBundle\Listener\InitializableControllerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContextInterface;

class BaseController extends Controller implements InitializableControllerInterface {

    public function setOrderCartContext(Request $request, SecurityContextInterface $security_context)
    {
        $orderService = $this->get('pp5_movie_universe.order.service');
        $userService = $this->get('pp5_movie_universe.user.service');

        $loggedUser = $security_context->isGranted(ApplicationConstantName::LOGGED_USER_ROLE);
        $user = $userService->getLoggedUser($loggedUser);
        $cookie = $request->cookies->get(ApplicationConstantName::COOKIE_ORDER_ID);

        $response = new Response();

        $orderId = null;

        if ($loggedUser) {
            if ($cookie) {
                $response->headers->clearCookie(ApplicationConstantName::COOKIE_ORDER_ID);
            }
            $orderId = $orderService->getOrderByUser($user)->getId();
        } else if ($cookie) {
            $orderId = $orderService->getOrderByID($cookie)->getId();
        }

        if ($orderId) {
            $request->getSession()->set(ApplicationConstantName::SESSION_ORDER_ID, $orderId);
        }

        $response->sendHeaders();
    }

} 