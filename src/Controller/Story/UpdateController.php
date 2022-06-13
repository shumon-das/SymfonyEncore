<?php

namespace App\Controller\Story;

use App\Controller\AbstractApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/update', name: 'update_story', methods: 'post')]
class UpdateController extends AbstractApiController
{
    public function action(): JsonResponse
    {
        return $this->json([
            'data' => [
                'id' => $this->request->request->get('id'),
                'name' => $this->request->request->get('name')
            ]
        ]);
    }
}