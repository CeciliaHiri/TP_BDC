<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\StationRepository;
use App\Repository\ConsommationRepository;
use App\Repository\ClientRepository;
use App\Entity\Consommation;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class EspaceProfileController extends AbstractController
{
    /**
     * @Route("/user/espaceProfile", name="espace_profile")
     */
    public function index(ConsommationRepository $consommationRepository): Response
    {
        if (is_null($this->getUser())) {
            return $this->redirectToRoute('login');
        }
        // s'assure de la sécurité de la route client
        $user = $this->getUser();
        if ($this->getUser()->getRoles() === ['ROLE_USER']) {
            $client = $user->getClient();
            $conso = $consommationRepository->findBy(['client' => $client]);

            return $this->render('espace_profile/index.html.twig', [
            'consos' => $conso,
            'clients' => $client,
            ]);
        }
        // pour des tests, j'ai les 2 rôles user et admin
        if ($this->getUser()->getRoles() === ['ROLE_ADMIN','ROLE_USER']) {
            return $this->redirectToRoute('admin');
        }
    }

    /**
     * @Route("/user/espaceProfileConso", name="espace_profile_conso")
     */
    public function DataConso(ConsommationRepository $consommationRepository): Response
    {
        return $this->render('espace_profile/index.html.twig', [
            'quantite' => $consommationRepository->findBy(['conso' => $conso]),
            'date_heure_connexion' => $consommationRepository->findBy(['conso' => $conso]),
            'date_heure_deconnexion' => $consommationRepository->findBy(['conso' => $conso]),
        ]);
      
    }

    /**
     * @Route("/user/espaceProfileStation", name="espace_profile_station")
     */
    /*public function DataStation(StationRepository $stationRepository): Response
    {
        return $this->render('espace_profile/index.html.twig', [
            'nom_station' => $stationRepository->findBy(['station' => $station]),
            'adresse_station' => $stationRepository->findBy(['station' => $station]),
            'tarification' => $stationRepository->findBy(['station' => $station]),

        ]);
    }*/
}
