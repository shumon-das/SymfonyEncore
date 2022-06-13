<?php

namespace App\Controller\Story;

use App\Controller\AbstractApiController;
use Symfony\Component\HttpFoundation\JsonResponse;


class GetByIdcController extends AbstractApiController
{
    public function action(): JsonResponse
    {
        return $this->json('something');
    }
}