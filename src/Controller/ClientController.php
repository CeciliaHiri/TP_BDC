<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientFormType;
use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class ClientController extends AbstractController
{
   
    private $twig;
    private $entityManager;

    public function __construct(Environment $twig, EntityManagerInterface $entityManager)
    {
         $this->twig = $twig;
         $this->entityManager = $entityManager;
    }

      /**
     * @Route("/client", name="client")
     */


    public function index(Request $request, ClientRepository $clientRepository): Response
    {
        $client = new Client();
        $form = $this->createForm(ClientFormType::class, $client);
        $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $client->setClient($client);
        
            $this->entityManager->persist($client);
            $this->entityManager->flush();
        
                return $this->redirectToRoute('conference', ['slug' => $conference->getSlug()]);
        }


        return $this->render('client/index.html.twig', [
            'client_form' => $form->createView(),
        ]);
    }
}
