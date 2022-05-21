<?php

namespace App\Controller;

use App\Libraries\Authentication\Authentication;
use App\Libraries\UploadFiles;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private UploadFiles $uploadFiles;
    private Authentication $authentication;

    public function __construct(Authentication $authentication,EntityManagerInterface $entityManager, UploadFiles $uploadFiles)
    {
        $this->entityManager = $entityManager;
        $this->uploadFiles = $uploadFiles;
        $this->authentication = $authentication;
    }

    #[Route('/profile', name: 'user_profile')]
    public function profilePage(): Response
    {
        $user = $this->authentication->ifAuthenticated();

        return $this->render('user/profile.html.twig', [
            'data' => $user
        ]);
    }

    #[Route('/upload', name: 'upload-file', methods: 'post')]
    public function uploadFile(Request $request): Response
    {
        $file = $request->files->get('file');
        $filename = $file->getClientOriginalName();
        $this->uploadFiles->uploadSingleFile($file, $filename);

        return $this->render('user/profile.html.twig', [
            'data' => 'something wrong'
        ]);
    }
}