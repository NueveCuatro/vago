<?php

namespace App\Controller\Admin;

use App\Entity\Car;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use \EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Garage;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class CarCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Car::class;    
    }

   /*  AssociationField::new('brand') // remplacer par le nom de l'attribut spécifique, par exemple 'bodyShape'
    ->onlyOnDetail()
    ->formatValue(function ($value, $entity) {
        return implode(', ', $entity->getSubBrands()->toArray()); // ici getBodyShapes()
    });

    */

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('garage.name'),
            TextField::new('name'),
            AssociationField::new('garage')
                ->onlyOnDetail(),
            AssociationField::new('brand') // remplacer par le nom de l'attribut spécifique, par exemple 'bodyShape'
                ->onlyOnDetail()
                ->formatValue(function ($value, $entity) {
                    return implode(', ', $entity->getBrand()->toArray()); // ici getBodyShapes()
        })
        ];
    }

    public function configureActions(Actions $actions): Actions
    {

    return $actions
        ->add(Crud::PAGE_INDEX, Action::DETAIL)
    ;
    }
}
