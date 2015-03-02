<?php

namespace PP5\MovieUniverseBundle\Listener;

use Symfony\Bundle\TwigBundle\Controller\ExceptionController;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\Security\Core\SecurityContextInterface;

class BeforeControllerListener {

    private $security_context;

    public function __construct(SecurityContextInterface $security_context)
    {
        $this->security_context = $security_context;
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();

        if (!is_array($controller)) {
            return;
        }

        $controllerObject = $controller[0];

        if ($controllerObject instanceof ExceptionController) {
            return;
        }

        if ($controllerObject instanceof InitializableControllerInterface) {
            $controllerObject->setOrderCartContext($event->getRequest(), $this->security_context);
        }
    }

} 