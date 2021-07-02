<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Admin;
use App\Form\ClientFormType;
use App\Repository\ClientRepository;
use App\Repository\AdminRepository;
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


    public function index(Request $request, ClientRepository $clientRepository, AdminRepository $adminRepository): Response
    {
        $client = new Client();
        $form = $this->createForm(ClientFormType::class, $client);
        $form->handleRequest($request);
        $existUsername = null;
        if ($form->isSubmitted()) {
            $existUsername = $adminRepository->findOneBy(['username' => $request->request->get('client_form')['username']]);
        }
        if ($form->isSubmitted() && $form->isValid() && is_null($existUsername)) {
            $date = new \DateTime('now');
            $client->setDateDebutContrat($date);
            $this->entityManager->persist($client);
            $this->entityManager->flush();

            //créée l'utilisateur
            $user = new Admin();
            $user->setUsername($request->request->get('client_form')['username']);
            $user->setClient($client);
            //bien définir le rôle pour ne pas que l'utilisateur puisse avoir les droits de l'admin
            $user->setRoles(['ROLE_USER']);
            $pwd = $request->request->get('client_form')['password']['first'];
            $user->setPassword($this->hasher->hashPassword(
                $user,
                $pwd
            ));
            $this->entityManager->persist($user);
            $this->entityManager->flush();
            return $this->redirectToRoute('');
        }

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        
        return $this->render('client/index.html.twig', [
            'client_form' => $form->createView(),
        ]);
    }
}
