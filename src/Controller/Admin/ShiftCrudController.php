<?php

namespace App\Controller\Admin;

use App\Entity\Shift;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ShiftCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Shift::class;
    }


    
   
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            DateTimeField::new('start'),
            DateTimeField::new('end'),
        ];
    }
    
}
