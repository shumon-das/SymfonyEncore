<?php

namespace App\Libraries;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;

class FileUploader extends AbstractController
{
    private string $uploadDir;
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger, $uploadDir)
    {
        $this->logger = $logger;
        $this->uploadDir = $uploadDir;
    }

    public function uploadSingleFile($file): string
    {
        if (empty($file))
        {
            return new Response("No file specified",
               Response::HTTP_UNPROCESSABLE_ENTITY, ['content-type' => 'text/plain']);
        }
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $fileName = $originalFilename.'-'.uniqid('', true).'.'.$file->guessExtension();

        try {
            $file->move($this->uploadDir, $fileName);
        } catch (FileException $e){
            $this->logger->error('failed to upload image: ' . $e->getMessage());
            throw new FileException($e->getMessage());
        }
        return $fileName;
    }

//    public function uploadMultipleFiles()
//    {
//
//    }

}