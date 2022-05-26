<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserDetails;
use App\Libraries\FileUploader;
use App\Repository\UserDetailsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;


class UserController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private FileUploader $uploadFiles;
    private UserDetailsRepository $details;

    public function __construct(EntityManagerInterface $entityManager, FileUploader $uploadFiles, UserDetailsRepository $details)
    {
        $this->entityManager = $entityManager;
        $this->uploadFiles = $uploadFiles;
        $this->details = $details;
    }

    /**
     * @return Response
     * @var User $user
     */
    #[Route('/profile', name: 'user_profile')]
    public function profilePage(UserInterface $user): Response
    {
//        $user = $this->getUser();
        if(!$this->getUser()){
            return $this->redirectToRoute('app_login');
        }
        $userInfo['id'] =  $user->getId();
        $userInfo['email'] =  $user->getEmail();
        $userInfo['roles'] =  $user->getRoles();
        $userInfo['firstName'] =  $user->getFirstName();
        $userInfo['lastName'] =  $user->getLastName();
        $userInfo['username'] =  $user->getUsername();
        $userInfo['type'] =  $user->getType();
        $userInfo['createdAt'] =  $user->getCreatedAt();
        $userInfo['updatedAt'] =  $user->getUpdatedAt();

        $detail = $this->details->findOneBy(['userId' => $user->getId()]);
        $userInfo['photo'] =  $detail->getPhoto();
        $userInfo['backPhoto'] =  $detail->getBackPhoto();
        $userInfo['address'] =  $detail->getAddress();
        $userInfo['status'] =  $detail->getStatus();

        return $this->render('user/profile.html.twig', [
            'data' => $userInfo
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @var User $user
     */
    #[Route('/profile-photo', name: 'profile-photo', methods: 'post')]
    public function uploadFile(Request $request, UserInterface $user): RedirectResponse
    {
        $file = $request->files->get('file');
        $uploadedFileName = $this->uploadFiles->uploadSingleFile($file);

        $userDetails = $this->entityManager->getRepository(UserDetails::class)->find($user->getId());
        if (!$userDetails) {
            throw $this->createNotFoundException(
                'No product found for user id '.$user->getId()
            );
        }
        $userDetails->setPhoto($uploadedFileName);

        $this->entityManager->persist($userDetails);
        $this->entityManager->flush($userDetails);

        return $this->redirectToRoute('user_profile');
    }
}