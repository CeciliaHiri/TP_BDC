<?php

namespace App\Controller;

use App\Entity\Station;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\StationRepository;

class CarteController extends AbstractController
{
    /**
     * @Route("/map", name="map")
     */
    public function map($localisation, $posx, $posy, $adresse, $nom): Response
    {
        return $this->render('carte/index.html.twig', [
            'controller_name' => 'CarteController',
        ]);
    }
}
