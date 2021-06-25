<?php

namespace App\Controller;

use App\Entity\Operateur;
use App\Entity\Station;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\OperateurRepository;
use App\Repository\StationRepository;

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

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/bdd", name="base_de_donnee")
     */
    public function bdd(OperateurRepository $operateur, StationRepository $station)
    {
        $url = "https://static.data.gouv.fr/resources/fichier-consolide-des-bornes-de-recharge-pour-vehicules-electriques/20210604-184648/irve-2.0.0.csv";

        $handle = fopen($url, 'r');
        $countline = true;
        while ($line = fgetcsv($handle, 0, ',')) {
            if ($countline) {
                $countline = false;
                continue;
            }

            $o = $operateur->findOneBy(['nom' => $line[3]]);
            if (is_null($o)) {
                $o = new Operateur();
                $o->setnom($line[3]);
                $o->setmail($line[4]);
                $o->setnumSiren($line[1]);
                $this->entityManager->persist($o);
                $this->entityManager->flush();
            }

            $s = $station->findOneBy(['localisation' => $line[13]]);
            if (is_null($s)) {
                $s = new Station();
                $s->setIdStation($line[8]);
                $s->setNomStation($line[9]);
                $s->setNbBornes((int)$line[14]);
                $s->setAdresseStation($line[11]);
                $s->setLocalisation($line[13]);
                $s->setOperateur($o);

                /** Division de la localisation */
                $localisation = $line[13];
                $crochet = array("[", "]"); // Suppression crochet
                $localisation = str_replace($crochet, "", $line[13]);
                list($posX, $posY) = explode(",", $localisation); 
            
                $s->setPositionX((float) $posX);
                $s->setPositionY((float) $posY);
                    
                $this->entityManager->persist($s);
                $this->entityManager->flush();
            }
        }
    }
}

