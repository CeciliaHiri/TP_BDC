<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Client;
use App\Entity\Consommation;
use App\Entity\Facture;
use App\Entity\Operateur;
use App\Entity\Station;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('TP BDC');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Client', 'fas fa-list', Client::class);
        yield MenuItem::linkToCrud('Consommation', 'fas fa-list', Consommation::class);
        yield MenuItem::linkToCrud('Facture', 'fas fa-list', Facture::class);
        yield MenuItem::linkToCrud('Operateur', 'fas fa-list', Operateur::class);
        yield MenuItem::linkToCrud('Station', 'fas fa-list', Station::class);
    }
}