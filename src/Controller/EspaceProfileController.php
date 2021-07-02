<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\StationRepository;
use App\Repository\ConsommationRepository;
use App\Repository\ClientRepository;
use App\Entity\Consommation;

class EspaceProfileController extends AbstractController
{
    /**
     * @Route("/user/espaceProfile", name="espace_profile")
     */
    public function index(): Response
    {
        $user = $this->getUser();
        if (getUser === NULL) {
            # code...
        }
        //si getUser === NULL, retour login
        $client = $user->getClient();
        $conso = $consommationRepository->findBy(['client' =>$client]);
      

        return $this->render('espace_profile/index.html.twig', [
            'conso' => $conso,
            'client' =>$client,


        ]);
    }


}
