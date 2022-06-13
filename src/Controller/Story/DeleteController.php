<?php

namespace App\Controller\Story;


use App\Controller\AbstractApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/delete/{id}', name: 'delete_story')]
class DeleteController extends AbstractApiController
{
    public function action(): JsonResponse
    {
        return $this->json('something');
    }
}