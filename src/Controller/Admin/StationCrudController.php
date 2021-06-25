<?php

namespace App\Controller\Admin;

use App\Entity\Station;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class StationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Station::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Station') 
            ->setEntityLabelInPlural('Stations');
            // ->setSearchFields(['date_facture', 'date_debut', 'date_fin'])
            // ->setDefaultSort(['date_facture' => 'DESC']);
    }

     public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id');
        yield TextField::new('nom_station');
        yield TextField::new('id_station');
        yield IntegerField::new('Nb_bornes');
        yield TextField::new('adresse_station');
        yield NumberField::new('positionx');
        yield NumberField::new('positiony');
        yield TextField::new('tarification')->hideOnIndex();
        yield TextField::new('localisation')->hideOnIndex();
        yield DateField::new('date_mise_en_service')->hideOnIndex();
              
    }
}
