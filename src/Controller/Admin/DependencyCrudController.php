<?php

namespace App\Controller\Admin;

use App\Entity\Dependency;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DependencyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Dependency::class;
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
