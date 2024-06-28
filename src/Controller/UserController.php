<?php
declare(strict_types=1);
namespace App\Controller;

use App\Service\ImageServiceInterface;
use App\Service\UserServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class UserController extends AbstractController
{
    private UserServiceInterface $userService;
    private ImageServiceInterface $imageService;
    public function __construct(UserServiceInterface $userService, ImageServiceInterface $imageService)
    {
       $this->userService = $userService;
       $this->imageService = $imageService;
    }

    public function index(): Response
    {
        return $this->render('/home.html.twig');
    }

    public function signUp(): Response
    {
        return $this->render('user/registerUser.html.twig');
    }


    public function registerUser(Request $request): Response
    {
        $avatarPath = $this->imageService->moveImageToUploads($request->files->get('avatar_path'));
        $id = $this->userService->registerUser(
            $request->get('first_name'), 
            $request->get('last_name'),
            $request->get('email'), 
            $request->get('phone'), 
            $request->get('role'),
            $request->get('password'),
            $avatarPath);
        
        return $this->render('/user/login.html.twig');    
    }

    public function userAuthenticate(Request $request, SessionInterface $session): Response
    {
        $email = $request->get('email');
        $password = $request->get('password');
        $exist = $this->userService->authentication($email, $password);
        $user = $this->userService->viewUser($email);
        $session->set('user_mail', $email);
        $session->set('user_id', $user->getUserId());
        if ($exist === 1) {
            return $this->redirect('/assortment');
        } elseif ($exist === 2) {
            return $this->redirect('/admin');
        } else {
            return $this->render('/user/login.html.twig');   
        }
    }

    public function viewUser(SessionInterface $session): Response
    {
        $email = $session->get('user_mail');
        $user = $this->userService->viewUser($email);
            if (!$user)
            {
                throw $this->createNotFoundException();
            }
    
            return $this->render('user/userPage.html.twig', [
                'user' => $user
             ]);

    }
}