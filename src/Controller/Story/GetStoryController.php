<?php

namespace App\Controller\Story;

use App\Controller\AbstractApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/story', name: 'get_story')]
class GetStoryController extends AbstractApiController
{
    public function action(): JsonResponse
    {
        return $this->json('something');
    }
}