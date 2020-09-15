<?php

namespace App\Controller;

use App\Entity\OrganisationUnit;
use App\Entity\Resource;
use App\Entity\ResourceGroup;
use App\Entity\Shift;
use App\Entity\ShiftWork;
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
        $ous = $em->getRepository(OrganisationUnit::class)->findAll();

        $shifts = $em->getRepository(Shift::class)->findAll();

        $managedShifts = $plannerManager->getManagedShifts();

        $resources = $em->getRepository(Resource::class)->findAll();
        return $this->render('planner/index.html.twig', [
            'ous' => $ous,
            'shifts' => $shifts,
            'resources' => $resources,
            'managedShifts' => $managedShifts
        ]);


    }

    /**
     * @Route("/shiftwork/add/{shift}/{resource}/{resourceGroup}", name="shiftwork_add")
     */
    public function shiftworkAdd(Shift $shift, Resource $resource, ResourceGroup $resourceGroup, EntityManagerInterface $em){

        $newShiftWork = new ShiftWork();
        $newShiftWork->setShift($shift);
        $newShiftWork->setResource($resource);
        $newShiftWork->setResourceGroup($resourceGroup);
        $em->persist($newShiftWork);
        $em->flush();
        
        return $this->redirectToRoute('planner');

    }

}