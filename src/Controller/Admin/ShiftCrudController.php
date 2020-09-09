<?php

namespace App\Controller\Admin;

use App\Entity\Shift;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ShiftCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Shift::class;
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
