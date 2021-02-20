<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route(path="/api/user/me", methods={"GET"})
     */
    public function me(): JsonResponse
    {
        return new JsonResponse($this->getUser());
    }
}
