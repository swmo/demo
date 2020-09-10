<?php

namespace App\Controller;

use App\Entity\Resource;
use App\Entity\Shift;
use App\Service\PlannerManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PlannerController extends AbstractController
{
    /**
     * @Route("/", name="planner")
     */
    public function index(EntityManagerInterface $em, PlannerManager $plannerManager)
    {
        $shifts = $em->getRepository(Shift::class)->findAll();

        $managedShifts = $plannerManager->getManagedShifts();

        $resources = $em->getRepository(Resource::class)->findAll();
        return $this->render('planner/index.html.twig', [
            'shifts' => $shifts,
            'resources' => $resources,
            'managedShifts' => $managedShifts
        ]);


    }
}
