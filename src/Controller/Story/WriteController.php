<?php

namespace App\Controller\Story;

use App\Controller\AbstractApiController;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\Routing\Annotation\Route;

#[Route('/story/idc', name: 'write_story')]
class WriteController extends AbstractApiController
{
    public function action(): JsonResponse
    {
        return $this->json('something');
    }
}
