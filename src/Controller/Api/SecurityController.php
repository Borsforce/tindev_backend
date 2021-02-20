<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Psl\Type as Type;

class SecurityController
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
     * @Route(path="/api/register")
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
