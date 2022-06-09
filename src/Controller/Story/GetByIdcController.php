<?php

namespace App\Controller\Story;

use App\Controller\AbstractApiController;
use Symfony\Component\HttpFoundation\Response;


class GetByIdcController extends AbstractApiController
{
    public function action(): Response
    {
        return $this->render('story/write.html.twig', [
            'controller_name' => 'StoryController',
        ]);
    }
}