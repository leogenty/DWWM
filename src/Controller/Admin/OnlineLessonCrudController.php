<?php

namespace App\Controller\Admin;

use App\Entity\OnlineLesson;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
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
            TextEditorField::new('description'),
            DateField::new('start_at'),
            DateField::new('end_at'),
            IntegerField::new('nb_participants'),
            TextField::new('class_link'),
        ];
    }
}
