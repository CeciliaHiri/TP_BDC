<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EspaceProfileController extends AbstractController
{
    /**
     * @Route("/espaceProfile", name="espace_profile")
     */
    public function index(): Response
    {
        return $this->render('espace_profile/index.html.twig', [
            'controller_name' => 'EspaceProfileController',
        ]);
    }
}
