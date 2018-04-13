<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EventoController extends Controller
{
    /**
     * @Route("/evento", name="evento")
     */
    public function index()
    {
        return $this->render('evento/index.html.twig', [
            'controller_name' => 'EventoController',
        ]);
    }
}
