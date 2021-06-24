<?php

namespace App\Controller;

use App\Entity\Operateur;
use App\Entity\Station;
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

    /**
     * @Route("/bdd", name="base_de_donnee")
     */
    public function bdd()
    {
        $url = "https://www.data.gouv.fr/fr/datasets/fichier-consolide-des-bornes-de-recharge-pour-vehicules-electriques/";

        $handle = fopen($url, 'r');
        $countline = true;
        while ($line = fgetcsv($handle, 0, ',')) {
            if ($countline) {
                $countline = false;
                continue;
            }

            $d = new Operateur();
            $d->setnom($line[0]);
            $d->setnumSiren($line[1]);
            $d->setmail($line[2]);
            // $d->adresse($line[0]);
            // $d->tarif($line[0]);
            // $d->date_debut_contrat($line[0]);
            // $d->date_fin_contrat($line[0]);
        }
    }
}
