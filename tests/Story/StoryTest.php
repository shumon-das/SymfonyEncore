<?php

namespace App\Tests\Story;

use App\CustomApiTest;

class StoryTest extends CustomApiTest
{
    public function testSomething(): void
    {
        $this->assertTrue(true);
    }

    public function testCreateUser(): void
    {
        $this->createUser();
        self::assertTrue(true);
    }
}