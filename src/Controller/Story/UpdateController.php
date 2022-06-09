<?php

namespace App\Controller\Story;

use App\Controller\AbstractApiController;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UpdateController extends AbstractApiController
{
    private RequestStack $request;

    public function __construct(RequestStack $requestStack)
    {
        $this->request = $requestStack;
    }

    #[Route('/update/{id}', name: 'update_story')]
    public function action(): Response
    {
        $request = $this->request->getCurrentRequest();
        return $this->render('story/write.html.twig', [
            'id' => $request?->get('id'),
        ]);
    }
}