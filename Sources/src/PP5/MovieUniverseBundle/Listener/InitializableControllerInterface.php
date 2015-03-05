<?php

namespace PP5\MovieUniverseBundle\Listener;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;

interface InitializableControllerInterface {

    public function setOrderCartContext(Request $request, SecurityContextInterface $security_context);

}