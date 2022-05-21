<?php

namespace App\Libraries\Authentication;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\User\UserInterface;

class Authentication extends AbstractController
{
    public function ifAuthenticated(): redirectResponse|UserInterface
    {
        $user = $this->getUser();
        if(!$user){
            return $this->redirectToRoute('app_login');
        }
        return $user;
    }
}