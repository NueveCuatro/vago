<?php

namespace App\Controller\Admin;

use App\Entity\Car;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use \EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;

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

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
