<?php

namespace App\Controller;

use App\Entity\Poster;
use App\Form\PosterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/poster', name: 'pm_poster_')]
class PosterController extends AbstractController
{
    #[Route(path: '/new', name: 'new')]
    public function map(
        EntityManagerInterface $entityManager,
        Request $request,
    ): Response
    {
        $lat = $request->get('lat');
        $lng = $request->get('lng');

        $poster = new Poster($lat, $lng);
        $form = $this->createForm(PosterType::class, $poster);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($poster);
            $entityManager->flush();

            return $this->redirectToRoute('pm_map');
        }

        return $this->render('poster/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

}