<?php

namespace App\Libraries;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;

class UploadFiles extends AbstractController
{
    protected string $uploadDir;
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger, $uploadDir)
    {
        $this->uploadDir = $uploadDir;
        $this->logger = $logger;
    }

    public function uploadSingleFile($file, $filename): Response
    {
        if (empty($file))
        {
            return new Response("No file specified",
               Response::HTTP_UNPROCESSABLE_ENTITY, ['content-type' => 'text/plain']);
        }

        try {
            $file->move($this->uploadDir, $filename);
            return $this->render('user/profile.html.twig', [
            'data' => 'File uploaded successfully'
        ]);
        } catch (FileException $e){
            $this->logger->error('failed to upload image: ' . $e->getMessage());
            throw new FileException($e->getMessage());
        }
    }

//    public function uploadMultipleFiles()
//    {
//
//    }

}