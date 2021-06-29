<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientFormType;
use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    /**
     * @Route("/client", name="client")
     */
    public function index(Request $request, Client $client, CientRepository $clientRepository): Response
    {
        $client = new Client();
        $form = $this->createForm(ClientFormType::class, $client);
        return $this->render('client/index.html.twig', [
            'client_form' => $form->createView(),
        ]);
    }
}
