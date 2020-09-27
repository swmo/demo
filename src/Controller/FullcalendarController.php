<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use App\Service\PlannerManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class FullcalendarController extends AbstractController
{
    /**
     * @Route("/api", name="fullcalendar")
     */
    public function api()
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }
    /**
     * @Route("/fullcalendar/project/resources/{project}", name="fullcalendar_project_resources")
     */
    public function fullcalendar_project_resources(Project $project, ProjectRepository $projectRepository)
    {
        $projectResources = $project->getProjectResources();
        $jsonArray = [];

        foreach($projectResources as $projectResource){
            $jsonResource['id'] = $projectResource->getId();
            $jsonResource['title'] = $projectResource->getName();
            $jsonArray[] = $jsonResource;
        }
        return new JsonResponse($jsonArray);
    }

    /**
     * @Route("/fullcalendar/project/events/{project}", name="fullcalendar_project_events")
     */
    public function fullcalendar_project_events(Project $project, PlannerManager $plannerManager){
      
        // todo: instead use  $project->getProjectResources()
        $projectShifts = $project->getShifts();

        $jsonArray = [];

        foreach($projectShifts as $projectShift){
            $jsonEvent['id'] = $projectShift->getId();
            $jsonEvent['title'] = $projectShift->getName();
            $jsonEvent['start'] = $projectShift->getStart()->format('Y-m-d H:i');
            $jsonEvent['end'] = $projectShift->getEnd()->format('Y-m-d H:i');
            $resourceIds = [];
            foreach($projectShift->getShiftWorks() as $shiftWork){
                $resourceIds[] = $shiftWork->getResource()->getId();
            }
            $jsonEvent['resourceIds'] = $resourceIds;
           
           // $jsonArray[]['resourceIds'] = $projectShift-;

           $managedShift = $plannerManager->getManagedShiftsByShift($projectShift);

           $bookedResources=[];
           $managedShiftWorks=[];

           foreach($managedShift->getAll() as $msw){
                $managedShiftWork = [];
               foreach($msw['shiftWorks'] as $shiftWork){
                    $bookedResources[] = $shiftWork->getResource()->getId();
                    $shiftWorkArray['resource']['id'] = $shiftWork->getResource()->getId();
                    $shiftWorkArray['resource']['name'] = $shiftWork->getResource()->getName();
                    $managedShiftWork['shiftWorks'][] = $shiftWorkArray;     
               }
            
               $managedShiftWork['openNumber'] = $msw['openNumber'];
               $managedShiftWork['shift']['id'] = $msw['shift']->getId();
               $managedShiftWork['resourceGroup']['id'] = $msw['resourceGroup']->getId();
               $managedShiftWork['resourceGroup']['name'] = $msw['resourceGroup']->getName();

            

               $managedShiftWorks[] = $managedShiftWork;

           }

           $bookableResources = [];
           foreach($managedShift->searchBookableRessource() as $bookableResource){
                $resource  = [];
                $resource['id'] = $bookableResource->getId();
                $resource['name']  = $bookableResource->getName();
                $resource['resourceGroups'] = array_map(function($resourceGroup){
                    $array = [];
                    $array['id'] = $resourceGroup->getId();
                    $array['name'] = $resourceGroup->getName();
                    return $array;
                },$bookableResource->getResourceGroups()->toArray());

                $bookableResources[] = $resource;
           }

           $jsonEvent['bookableResources'] = $bookableResources;
           $jsonEvent['managedShiftWorks'] = $managedShiftWorks;

           $jsonArray[] = $jsonEvent;

            //{ id: '1', resourceId: 'a', start: '2020-09-07T07:00:00', end: '2020-09-07T12:00:00', title: 'Schicht 01', resources: [1,2,3,4,5] },
        }
        return new JsonResponse($jsonArray);  
    }
}
