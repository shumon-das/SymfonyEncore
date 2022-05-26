<?php

namespace App\Message;

final class PracticeMail
{
    /*
     * Add whatever properties and methods you need
     * to hold the data for this message class.
     */

     private array $mailData;

     public function __construct(array $mailData)
     {
         $this->mailData = $mailData;
     }

    public function getMailData(): array
    {
        return $this->mailData;
    }
}
