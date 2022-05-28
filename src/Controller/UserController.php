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
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\UserInterface;


class UserController extends AbstractSeController
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
     * @param TokenStorageInterface $tokenStorage
     * @return Response
     */
    #[Route('/profile', name: 'user_profile')]
    public function profilePage(TokenStorageInterface $tokenStorage): Response
    {
        if(!$this->getUser()){
            return $this->redirectToRoute('app_login');
        }
        $user = $tokenStorage->getToken() ? $tokenStorage->getToken()->getUser() : [];
        if($user instanceof User){
            $userInfo['id'] = $user->getId();
            $userInfo['email'] =  $user->getEmail();
            $userInfo['roles'] =  $user->getRoles();
            /** @var UserDetails $detail */
            $detail = $this->details->findOneBy(['userId' => $user->getId()]);
            $userInfo['firstName'] =  $detail->getFirstName();
            $userInfo['lastName'] =   $detail->getLastName();
            $userInfo['username'] =   $detail->getUsername();
            $userInfo['createdAt'] =  $detail->getCreatedAt();
            $userInfo['updatedAt'] =  $detail->getUpdatedAt();
            $userInfo['photo'] =      $detail->getPhoto();
            $userInfo['backPhoto'] =  $detail->getBackgroundPhoto();
            $userInfo['address'] =    $detail->getAddress();

            return $this->render('user/profile.html.twig', [
            'data' => $userInfo
            ]);
        }

       return $this->redirectToRoute('app_login');
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