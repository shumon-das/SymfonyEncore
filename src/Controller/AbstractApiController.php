<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Throwable;

abstract class AbstractApiController extends AbstractController
{
    protected Request $request;

    /**
     * @param Request $request
     * @param LoggerInterface $logger
     * @return JsonResponse|void
     */
    public function __invoke(Request $request, LoggerInterface $logger)
    {

        try{
            $this->request = $request;
            return $this->action();
        }catch (Throwable $e) {
            $logger->error("AbstractApiController::__invoke() - " . get_class($e) . " - File: " . $e->getFile() .
                " - Line: " . $e->getLine() . " - Code: " . $e->getCode() . " - Message: " . $e->getMessage() .
                " - Trace: " . $e->getTraceAsString()
            );
        }
    }

    abstract public function action(): JsonResponse;
}