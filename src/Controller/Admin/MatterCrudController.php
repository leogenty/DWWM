<?php

namespace App\Controller\Admin;

use App\Entity\Matter;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MatterCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Matter::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            AssociationField::new('category'),
        ];
    }
}
