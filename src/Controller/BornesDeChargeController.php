<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BornesDeChargeController extends AbstractController
{
    /**
     * @Route("/bdc", name="bornes_de_charge")
     */
    public function index(): Response
    {
        return $this->render('bornes_de_charge/index.html.twig', [
            'controller_name' => 'BornesDeChargeController',
        ]);
    }
}
