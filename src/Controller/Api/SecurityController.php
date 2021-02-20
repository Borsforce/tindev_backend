<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Dto\SignIn;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use Psl\Type as Type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    private UserRepository $userRepository;
    private EntityManagerInterface $entityManager;
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserRepository $userRepository, EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Rest\Post("api/authentication/sign-in")
     * 
     * @OA\Tag(name="Authentication")
     * 
     * @OA\RequestBody(
     *     description="SignIn",
     *     required=true
     * )
     * 
     * @OA\Response(
     *     response=200,
     *     description="If the authentification succeded, a JWT token is returned"
     * )
     * 
     * @param Request $request
     * 
     */
    public function signIn(Request $request)
    {
        $user = $this->getUser();

        return $this->json([
            'username' => $user->getUsername(),
            'roles' => $user->getRoles(),
        ]);
    }

    /**
     * @Rest\Post("api/user/register")
     *
     * @OA\Tag(name="User")
     * 
     * @OA\Response(
     *     response="204",
     *     description="When the registration was successful"
     * )
     * @OA\Response(
     *     response="400",
     *     description="When the username or email is already taken"
     * )
     */
    public function register(Request $request): Response
    {
        $payload = Type\shape([
            'username' => Type\string(),
            'password' => Type\string(),
            'email' => Type\string()
        ])->assert($request->request->all());

        $this->userRepository->checkUniquenessOfUser($payload['username'], $payload['email']);

        $user = new User();
        $user->setEmail($payload['email']);
        $user->setUsername($payload['username']);
        $user->setPassword($this->passwordEncoder->encodePassword($user, $payload['password']));

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}
