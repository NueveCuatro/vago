<?php

namespace App\Controller\Admin;

use App\Entity\Garage;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Doctrine\Persistence\ManagerRegistry;

class GarageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Garage::class;
        
    }
    

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            AssociationField::new('garage')
                ->onlyOnDetail()
                ->setTemplatePath('admin/fields/garage_car.html.twig')
        ];
    }
    
    public function configureActions(Actions $actions): Actions
    {

    return $actions
        ->add(Crud::PAGE_INDEX, Action::DETAIL)
    ;
    }
}
