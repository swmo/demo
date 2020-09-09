<?php

namespace App\Controller\Admin;

use App\Entity\Block;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BlockCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Block::class;
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
