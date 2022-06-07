<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/write', name: 'app_story')]
class StoryController extends AbstractApiController
{
//    public function index(): Response
//    {
//        return $this->render('story/index.html.twig', [
//            'controller_name' => 'StoryController',
//        ]);
//    }
    public function action(): Response
    {
        return $this->render('story/write.html.twig');
    }
}
