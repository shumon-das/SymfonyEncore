<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class AbstractSeController extends AbstractController
{
    public function __invoke(TokenStorageInterface $tokenStorage)
    {
        $checkUserLoggedInOrNot = $tokenStorage->getToken()->getUser();
        if(!$checkUserLoggedInOrNot instanceof User){
            $this->redirectToRoute('app_login');
        }
    }
}
