<?php

namespace App\Controller\Admin;

use App\Entity\Operateur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;

class OperateurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Operateur::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Opérateur') 
            ->setEntityLabelInPlural('Opérateurs');
            // ->setSearchFields(['date_facture', 'date_debut', 'date_fin'])
            // ->setDefaultSort(['date_facture' => 'DESC']);
    }

     public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id');
        yield TextField::new('nom');
        yield EmailField::new('mail');
        yield IntegerField::new('numSiren');
        yield TextField::new('adresse')->hideOnIndex();
        yield TextField::new('tarif')->hideOnIndex();
        yield DateField::new('date_debut_contrat')->hideOnIndex();
        yield DateField::new('date_fin_contrat')->hideOnIndex();
              
    }
}

