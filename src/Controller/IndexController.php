<?php

namespace App\Controller;

use App\Repository\StationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(StationRepository $station, SerializerInterface $serializer): Response
    {
        $stations = $station->findAll();
        $stationss = array();
        foreach ($stations as $s) {
            $stationss[] = $serializer->serialize($s, 'json', ['groups' => ['listStation']]);
        }
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'station' => $stationss,
        ]);
    }
}
