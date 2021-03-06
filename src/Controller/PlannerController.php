<?php

namespace App\Controller;

use App\Entity\OrganisationUnit;
use App\Entity\Project;
use App\Entity\Resource;
use App\Entity\ResourceGroup;
use App\Entity\Shift;
use App\Entity\ShiftWork;
use App\Repository\ProjectRepository;
use App\Service\PlannerManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
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
    public function shiftworkAdd(Shift $shift, Resource $resource, ResourceGroup $resourceGroup, EntityManagerInterface $em,Request $request){

        $newShiftWork = new ShiftWork();
        $newShiftWork->setShift($shift);
        $newShiftWork->setResource($resource);
        $newShiftWork->setResourceGroup($resourceGroup);
        $em->persist($newShiftWork);
        $em->flush();


        
        return $this->redirectToRouteOrForward('planner',$request);

    }

    /**
     * @Route("/shift/{shift}", name="shift")
     */
    public function shift(EntityManagerInterface $em, PlannerManager $plannerManager)
    {
  
        $managedShifts[] = $plannerManager->getManagedShiftsByShift($shift);

        $resources = $em->getRepository(Resource::class)->findAll();
        return $this->render('planner/index.html.twig', [
            'managedShifts' => $managedShifts
        ]);


    }


    //shiftwork_remove

    /**
     * @Route("/shiftwork/remove/{id}", name="shiftwork_remove")
     */
    public function shiftwork_remove(ShiftWork $shiftWork, EntityManagerInterface $em)
    {
  
        $em->remove($shiftWork);
        $em->flush();
       
        return $this->redirectToRoute('planner');

    }


    /**
     * @Route("/project/list", name="project_list")
     */
    public function project_list(ProjectRepository $projectRepository){
        $projects = $projectRepository->findAll();

        return $this->render('project/list.html.twig',[
            'projects' => $projects
        ]);
    }

    /**
     * @Route("/project/calendar/{project}", name="project_calendar")
     */
    public function project_calendar(Project $project){
        
        return $this->render('project/calendar.html.twig',[
            'project' => $project
        ]);
    }

    public function redirectToRouteOrForward(string $route,$request){
        
        if($forward = $request->query->get('forward')){
            return $this->redirect($forward);
        }
       
        return $this->redirectToRoute($route);
    }
    

}