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
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
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
        yield IdField::new('id')->onlyOnIndex();
        yield TextField::new('nom_station')->onlyOnIndex();
        yield TextField::new('id_station')->onlyOnIndex();
        yield IntegerField::new('Nb_bornes')->onlyOnIndex();
        yield TextField::new('adresse_station')->onlyOnIndex();
        yield NumberField::new('positionx')->onlyOnIndex();
        yield NumberField::new('positiony')->onlyOnIndex();
        yield TextField::new('localisation')->onlyWhenCreating();
        yield TextField::new('tarification')->hideOnIndex();
        yield DateTimeField::new('date_mise_en_service', 'Date de Mise en Service')
            ->setFormTypeOptions([
                'html5' => true,
                'years' => range(date('Y'), date('Y') + 2),
                'widget' => 'single_text',
            ])->hideOnIndex();
              
    }
}
