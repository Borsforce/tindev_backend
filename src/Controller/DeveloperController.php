<?php

namespace App\Controller;

use App\Repository\DeveloperRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeveloperController extends AbstractController
{
    /**
     * @Route("/developer", name="developer")
     */
    /*public function index(): Response
    {
        return $this->render('developer/index.html.twig', [
            'controller_name' => 'DeveloperController',
        ]);
    }*/

    public function getDeveloper(int $id, DeveloperRepository $developerRepository): Response
    {
        $developer = $developerRepository
            ->find($id);

        if (!$developer) {
            throw $this->createNotFoundException(
                'No developer found for id '.$id
            );
        }

        return new Response(json_encode($developer));
    }
}
