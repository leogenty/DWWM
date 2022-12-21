<?php

namespace App\Controller\Admin;

use App\Entity\Progression;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class ProgressionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Progression::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            IntegerField::new('complete'),
            AssociationField::new('user'),
            AssociationField::new('type'),
        ];
    }
}
