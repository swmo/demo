<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\ProjectRepository;
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
    public function fullcalendar_project_events(Project $project, ProjectRepository $projectRepository){
      
        $projectShifts = $project->getShifts();

        $jsonArray = [];

        foreach($projectShifts as $projectShift){
            $jsonEvent['id'] = $projectShift->getId();
            $jsonEvent['title'] = $projectShift->getName();
            $jsonEvent['start'] = '2020-09-07T07:00:00';
            $jsonEvent['end'] = '2020-09-07T12:00:00';
            $jsonEvent['resources'] = [1,2,3,4,5];
            $resourceIds = [];
            foreach($projectShift->getShiftWorks() as $shiftWork){
                $resourceIds[] = $shiftWork->getResource()->getId();
            }
            $jsonEvent['resourceIds'] = $resourceIds;
            $jsonArray[] = $jsonEvent;
           // $jsonArray[]['resourceIds'] = $projectShift-;

            //{ id: '1', resourceId: 'a', start: '2020-09-07T07:00:00', end: '2020-09-07T12:00:00', title: 'Schicht 01', resources: [1,2,3,4,5] },
        }
        return new JsonResponse($jsonArray);  
    }
}
