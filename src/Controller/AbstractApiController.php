<?php

namespace App\Controller;

use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

abstract class AbstractApiController extends AbstractController
{
    public function __invoke(LoggerInterface $logger)
    {
        try{
            return $this->action();
        }catch (Throwable $e) {
            $logger->error("AbstractApiController::__invoke() - " . get_class($e) . " - File: " . $e->getFile() .
                " - Line: " . $e->getLine() . " - Code: " . $e->getCode() . " - Message: " . $e->getMessage() .
                " - Trace: " . $e->getTraceAsString()
            );
        }
    }

    abstract public function action(): Response;
}