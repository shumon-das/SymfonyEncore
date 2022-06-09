<?php

namespace App\Controller\Story;

use App\Controller\AbstractApiController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/story/idc', name: 'write_story')]
class WriteController extends AbstractApiController
{
    public function action(): Response
    {
        return $this->render('story/write.html.twig', [
            'controller_name' => 'StoryController',
        ]);
    }
}
