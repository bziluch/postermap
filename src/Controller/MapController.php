<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MapController extends AbstractController
{
    #[Route(path: '/map', name: 'pm_map')]
    public function map(): Response
    {
        return $this->render('map/index.html.twig');
    }
}