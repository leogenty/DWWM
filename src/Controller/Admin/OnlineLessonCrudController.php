<?php

namespace App\Controller\Admin;

use App\Entity\OnlineLesson;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OnlineLessonCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OnlineLesson::class;
    }

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
