<?php

namespace App\Controller;

use App\Entity\Station;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\StationRepository;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class CarteController extends AbstractController
{
    /**
     * @Route("/map", name="map")
     */
    public function map(StationRepository $station, SerializerInterface $serializer): Response
    {
        $stations = $station->findAll();
        $stationss = array();
        foreach ($stations as $s) {
            $stationss[] = $serializer->serialize($s, 'json', ['groups' => ['listStation']]);
        }

        return $this->render(
            'carte/index.html.twig',
            array('station' => $stationss)
        );
    }
}
