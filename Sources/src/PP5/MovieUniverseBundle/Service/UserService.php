<?php

namespace PP5\MovieUniverseBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class UserService {

    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getLoggedUser($userName)
    {
        $userRepository = $this->entityManager->getRepository('PP5MovieUniverseBundle:User\User');
        $user = $userRepository->findOneBy(array("username" => $userName));

        return $user;
    }

} 