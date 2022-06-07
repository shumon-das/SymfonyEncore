<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/story/write', name: 'write_story')]
class StoryController extends AbstractApiController
{
//    #[Route('/story/write', name: 'write_story')]
//    public function writeStory(): Response
//    {
//        return $this->render('story/write.html.twig', [
//            'controller_name' => 'StoryController',
//        ]);
//    }
//
//    #[Route('/stories', name: 'get_stories')]
//    public function getStories(): Response
//    {
//        return $this->render('story/write.html.twig', [
//            'controller_name' => 'StoryController',
//        ]);
//    }
//
//    #[Route('/story/{id}}', name: 'get_story')]
//    public function getStory(): Response
//    {
//        return $this->render('story/write.html.twig', [
//            'controller_name' => 'StoryController',
//        ]);
//    }
//
//    #[Route('/story/{id}', name: 'update_story')]
//    public function updateStory(): Response
//    {
//        return $this->render('story/write.html.twig', [
//            'controller_name' => 'StoryController',
//        ]);
//    }
//
//    #[Route('/story/{id}', name: 'delete_story')]
//    public function deleteStory(): Response
//    {
//        return $this->render('story/write.html.twig', [
//            'controller_name' => 'StoryController',
//        ]);
//    }
//
//    #[Route('/story/{idc}', name: 'stories_by_story')]
//    public function getStoriesByIdc(): Response
//    {
//        return $this->render('story/write.html.twig', [
//            'controller_name' => 'StoryController',
//        ]);
//    }


    public function action(): Response
    {
        return $this->render('story/write.html.twig', [
            'controller_name' => 'StoryController',
        ]);
    }
}
