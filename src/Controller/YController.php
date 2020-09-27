<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class YController extends AbstractController
{
    /**
     * @Route("/y", name="y")
     */
    public function index()
    {
        return $this->render('y/index.html.twig', [
            'controller_name' => 'YController',
        ]);
    }
}
