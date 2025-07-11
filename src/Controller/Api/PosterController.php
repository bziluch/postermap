<?php

namespace App\Controller\Api;

use App\Entity\Poster;
use App\Repository\PosterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route(path: '/api/poster', name: 'pm_api_poster')]
class PosterController extends AbstractController
{
    #[Route(path: 's', name: 's', methods: ['GET'])]
    public function list(
        SerializerInterface $serializer,
        PosterRepository $repository
    ): JsonResponse
    {
        return JsonResponse::fromJsonString(
            $serializer->serialize($repository->findAll(), 'json')
        );
    }
}