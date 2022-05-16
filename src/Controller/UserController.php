<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/profile', name: 'user_profile')]
    public function getUserData(UserRepository $user): Response
    {
        $data = $user->find(1);

        return $this->render('user/profile.html.twig', [
            'data' => $data
        ]);
    }

}