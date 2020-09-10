<?php

namespace App\Controller\Admin;

use App\Entity\Block;
use App\Entity\Dependency;
use App\Entity\Resource;
use App\Entity\ResourceGroup;
use App\Entity\Shift;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Planner');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Block', 'icon class', Block::class);
        yield MenuItem::linkToCrud('Dependency', 'icon class', Dependency::class);
        yield MenuItem::linkToCrud('ResourceGroup', 'icon class', ResourceGroup::class);
        yield MenuItem::linkToCrud('Resource', 'icon class', Resource::class);
        yield MenuItem::linkToCrud('Shift', 'icon class', Shift::class);
    }
}
