<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Admin;
use App\Form\ClientFormType;
use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ClientController extends AbstractController
{
    private $entityManager;
    private $hasher;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $hasher)
    {
        $this->entityManager = $entityManager;
        $this->hasher = $hasher;
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
            $date = new \DateTime('now');
            $client->setDateDebutContrat($date);
            $this->entityManager->persist($client);
            $this->entityManager->flush();

            //créée l'utilisateur
            $user = new Admin();
            $user->setUsername($request->request->get('username'));
            $user->setClient($client);
            //bien définir le rôle pour ne pas que l'utilisateur puisse avoir les droits de l'admin
            $user->setRoles(['ROLE_USER']);
            $pwd = (string)$request->request->get('password');
            $user->setPassword($this->hasher->hashPassword(
                $user,
                $pwd
            ));
            $this->entityManager->persist($user);
            $this->entityManager->flush();
            return $this->redirectToRoute('client');
        }


        return $this->render('client/index.html.twig', [
            'client_form' => $form->createView(),
        ]);
    }
}
