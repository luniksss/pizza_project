<?php
declare(strict_types=1);
namespace App\Controller;

use App\Service\ImageServiceInterface;
use App\Service\UserServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

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

    public function userAuthenticate(Request $request): Response
    {
        $email = $request->get('email');
        $password = $request->get('password');
        $exist = $this->userService->authentication($email, $password);
        if ($exist === 1) {
            $request->getSession()->set(Security::LAST_USERNAME, $email);
            return $this->redirect('/assortment');
        } elseif ($exist === 2) {
            $request->getSession()->set(Security::LAST_USERNAME, $email);
            return $this->redirect('/admin');
        } else {
            return $this->render('/user/login.html.twig');   
        }
    }

}