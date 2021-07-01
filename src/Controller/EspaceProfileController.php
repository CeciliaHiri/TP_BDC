<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\StationRepository;
use App\Repository\ConsommationRepository;
use App\Repository\ClientRepository;


class EspaceProfileController extends AbstractController
{
    /**
     * @Route("/user/espaceProfile", name="espace_profile")
     */
    public function index(): Response
    {
        $user = $this->security->getUser();
        $client = $user->getClient();

        return $this->render('espace_profile/index.html.twig', [
            'controller_name' => 'Espace Client - Bornes Electriques',

        ]);
    }

    /**
     * @Route("/user/espaceProfileConso", name="espace_profile_conso")
     */
    public function DataConso(ConsommationRepository $consommationRepository): Response
    {
        return $this->render('espace_profile/index.html.twig',[
            'consommations' => $consommationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/user/espaceProfileStation", name="espace_profile_station")
     */
    public function DataStation(StationRepository $stationRepository): Response
    {
        return $this->render('espace_profile/index.html.twig',[
            'nom_station' => $StationRepository->findBy(['station' => $station]),
            'adresse_station' => $StationRepository->findBy(['station' => $station]),
            'tarification' => $StationRepository->findBy(['station' => $station]),

        ]);
    }

    /**
     * @Route("/user/espaceProfileStation", name="espace_profile_station")
     */
    public function DataClient(Clients $clients, ClientRepository $clientRepository): Response
    {
        return $this->render('espace_profile/index.html.twig',[
            'prenom' => $ClientRepository->findBy(['clients' => $clients]),


        ]);
    }


}
