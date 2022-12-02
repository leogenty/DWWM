<?php

namespace App\Controller\Admin;

use App\Entity\Block;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class BlockCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Block::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('lesson'),
            IntegerField::new('numbering'),
            TextEditorField::new('content'),
        ];
    }
}
