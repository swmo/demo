<?php

namespace App\Controller;

use App\Entity\Resource;
use App\Entity\Shift;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PlannerController extends AbstractController
{
    /**
     * @Route("/", name="planner")
     */
    public function index(EntityManagerInterface $em)
    {
        $shifts = $em->getRepository(Shift::class)->findAll();

        $resources = $em->getRepository(Resource::class)->findAll();
        return $this->render('planner/index.html.twig', [
            'shifts' => $shifts,
            'resources' => $resources
        ]);


    }
}
