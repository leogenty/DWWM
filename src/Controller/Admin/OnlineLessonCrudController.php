<?php

namespace App\Controller\Admin;

use App\Entity\OnlineLesson;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OnlineLessonCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OnlineLesson::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('author'),
            TextField::new('title'),
            AssociationField::new('language'),
            TextEditorField::new('description'),
            DateTimeField::new('start_at')->renderAsChoice()->setFormat('dd MMMM yyyy hh:mm'),
            DateTimeField::new('end_at')->renderAsChoice()->setFormat('dd MMMM yyyy hh:mm'),
            IntegerField::new('nb_participants'),
            TextField::new('class_link'),
        ];
    }
}
