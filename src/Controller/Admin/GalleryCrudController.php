<?php

namespace App\Controller\Admin;

use App\Entity\Gallery;
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
use Doctrine\DBAL\Query\QueryBuilder;

class GalleryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Gallery::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
        AssociationField::new('createur'),
        BooleanField::new('published')
        ->onlyOnForms()
        ->hideWhenCreating(),
        TextField::new('description'),

        AssociationField::new('cars')
        ->onlyOnForms()
        // on ne souhaite pas gérer l'association entre les
        // [objets] et la Gallery dès la crétion de la
        // Gallery
        ->hideWhenCreating()
        ->setTemplatePath('admin/fields/garage_car.html.twig')
        // Ajout possible seulement pour des [objets] qui
        // appartiennent même propriétaire de l'garage
        // que le creator$createur de la Gallery
        /*->setQueryBuilder(
            function (QueryBuilder $queryBuilder) {
            // récupération de l'instance courante de Gallery
            $currentGallery = $this->getContext()->getEntity()->getInstance();
            $createur = $currentGallery->getCreateur();
            $memberId = $createur->getId();
            // charge les seuls [objets] dont le 'owner' de l'garage est le creator$createur de la galerie
            $queryBuilder->leftJoin('entity.garage', 'i')
                ->leftJoin('i.owner', 'm')
                ->andWhere('m.id = :member_id')
                ->setParameter('member_id', $memberId);    
            return $queryBuilder;
            }
           ),*/
        ];
    }
}
