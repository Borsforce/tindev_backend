<?php

namespace App\Controller\Api;

use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @OA\Tag(name="User")
 */
class UserController extends AbstractController
{
    /**
     * @Route(path="/api/me", methods={"GET"})
     *
     * @OA\Parameter(
     *     name="Authorization",
     *     description="The Bearer access token with the 'Bearer' prefix",
     *     in="header",
     *     example="Bearer myAPIToken"
     * )
     * @OA\Response(
     *     response="200",
     *     description="When the user is successfully authenticated and the information could be fetched"
     * )
     *
     * @OA\Response(
     *     response="401",
     *     description="When the user is not authorized or the JWT token was not found in the 'Authorization' header"
     * )
     * @Security(name="Bearer")
     */
    public function me(): JsonResponse
    {
        return new JsonResponse($this->getUser());
    }
}
