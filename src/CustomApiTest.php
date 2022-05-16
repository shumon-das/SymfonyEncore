<?php

namespace App;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class CustomApiTest extends TestCase
{
    public function createUser(): User
    {
        $user = new User();
        $user->setRoles(['ROLE_USER'])
             ->setEmail('mono@mail.com')
             ->setPassword('$2y$13$FBBBRVb1wp4eQmercVveSuRLZV//P3V07HIQl9Lj76FHZnmYZ4kUu');

        return $user;
    }
}