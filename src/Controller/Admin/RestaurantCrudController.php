<?php

namespace App\Controller\Admin;

use App\Entity\Restaurant;
use App\Form\MediaType;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class RestaurantCrudController extends AbstractCrudController
{
    public const IMAGE_BASE_PATH='upload/images/restaurants';
    public const IMAGE_UPLOAD_DIR='public/upload/images/restaurants';
    public static function getEntityFqcn(): string
    {
        return Restaurant::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            DateTimeField::new('creatAt')->hideOnForm(),
            DateTimeField::new('updateAt')->hideOnForm(),
            AssociationField::new('city'),
            AssociationField::new('user'),
            CollectionField::new('media')
                ->setEntryType(MediaType::class)
                ->onlyOnForms(),
            
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if(!$entityInstance instanceof Restaurant) return;
        $entityInstance->setCreateAt(new \DateTimeImmutable);
        parent::persistEntity($entityManager, $entityInstance);
    }
    
}
