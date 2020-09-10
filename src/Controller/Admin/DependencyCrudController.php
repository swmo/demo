<?php

namespace App\Controller\Admin;

use App\Entity\Dependency;
use App\Entity\ResourceGroup;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DependencyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Dependency::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('number')->hideOnIndex(),
            AssociationField::new('resourceGroup')
                ->setFormTypeOption('class', ResourceGroup::class)
                ->hideOnIndex(),
        ];

    }
    
}
