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
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

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
        yield IdField::new('id')->onlyOnIndex();
        yield TextField::new('nom')->onlyOnIndex();
        yield EmailField::new('mail')->onlyOnIndex();
        yield IntegerField::new('numSiren')->onlyOnIndex();
        yield TextField::new('adresse')->hideOnIndex();
        yield TextField::new('tarif')->hideOnIndex();
        yield DateTimeField::new('date_debut_contrat', 'Debut du Contrat')
            ->setFormTypeOptions([
                'html5' => true,
                'years' => range(date('Y'), date('Y') + 2),
                'widget' => 'single_text',
            ])->hideOnIndex();
        yield DateTimeField::new('date_fin_contrat', 'Fin du Contrat')
            ->setFormTypeOptions([
                'html5' => true,
                'years' => range(date('Y'), date('Y') + 2),
                'widget' => 'single_text',
            ])->hideOnIndex();
        //yield DateTimeField::new('date_debut_contrat')->hideOnIndex();
        //yield DateTimeField::new('date_fin_contrat')->hideOnIndex();
    }
}
