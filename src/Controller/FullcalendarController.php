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
    public function fullcalendar_project_resources(Project $project = null, ProjectRepository $projectRepository)
    {
        $project = $projectRepository->findOneBy(array());

        $projectShifts = $project->getShifts();

        $jsonArray = [];

        foreach($projectShifts as $projectShift){
            $jsonArray[]['id'] = $projectShift->getId();
            $jsonArray[]['title'] = $projectShift->getName();
        }
        return new JsonResponse($jsonArray);
    }
    
    /**
     * @Route("/fullcalendar/project/events/{project}", name="fullcalendar_project_events")
     */
    public function fullcalendar_project_events(Project $project = null, ProjectRepository $projectRepository){
      
        $project = $projectRepository->findOneBy(array());

        $projectShifts = $project->getShifts();

        $jsonArray = [];

        foreach($projectShifts as $projectShift){
            $jsonArray[]['id'] = $projectShift->getId();
           // $jsonArray[]['resourceIds'] = $projectShift-;

            //{ id: '1', resourceId: 'a', start: '2020-09-07T07:00:00', end: '2020-09-07T12:00:00', title: 'Schicht 01', resources: [1,2,3,4,5] },
        }
        return new JsonResponse($jsonArray);  
    }
}
