<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserDetails;
use App\Libraries\FileUploader;
use App\Repository\UserDetailsRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
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

            return $this->render('user/userProfile.html.twig', [
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
        if($file->guessExtension() !== "jpg" && $file->guessExtension() !== "jpeg" && $file->guessExtension() !== "png"){
            throw new FileException('the file must be an image... but you are trying to upload '.$file->guessExtension().' file');
        }
        $uploadedFileName = $this->uploadFiles->uploadSingleFile($file);

        $userDetails = $this->entityManager->getRepository(UserDetails::class)->findOneBy(['userId' => $user->getId()]);
        if (!$userDetails) {
            throw new NotFoundHttpException('User Not Found!');
        }
        $userDetails->setPhoto($uploadedFileName);

        $this->entityManager->persist($userDetails);
        $this->entityManager->flush();

        return $this->redirectToRoute('user_profile');
    }

    #[Route('/register', name: 'register')]
    public function userRegistration(): Response
    {
        return $this->render('user/register.html.twig');
    }

    /**
     * @throws \Exception
     */
    #[Route('/registration', name: 'registration', methods: 'post')]
    public function Registration(Request $request, UserPasswordHasherInterface $passwordHasher): Response|RedirectResponse
    {
        $user = new User();
        $requestedData = $request->request;
        $email = $requestedData->get("email");
        $roles = $requestedData->get("roles");
        $plainPassword = $requestedData->get("password");
        $password = $passwordHasher->hashPassword($user, $plainPassword);
        $user->setEmail($email)
             ->setRoles([$roles])
             ->setPassword($password)
        ;

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $userDetails = new UserDetails();
        $firstName = $requestedData->get("first_name");
        $lastName = $requestedData->get("last_name");
        $username = $requestedData->get("username");
        $userDetails->setFirstName($firstName)
                    ->setLastName($lastName)
                    ->setUsername($username)
                    ->setCreatedAt(new DateTimeImmutable(date("Y-m-d h:i:s")))
                    ->setUserId($user->getId())
                    ->setPhoto('user.png')
                    ->setBackgroundPhoto('background-image4.jpg')
        ;
        $this->entityManager->persist($userDetails);
        $this->entityManager->flush();
        return $this->redirectToRoute('app_login');
    }

    #[Route('/test', name: 'test')]
    public function tests(): Response
    {
        return $this->render('test.html.twig');
    }
}