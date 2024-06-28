<?php
declare(strict_types=1);
namespace App\Controller;

use App\Service\ImageServiceInterface;
use App\Service\UserServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
        // return $this->render('user/registerUser.html.twig');
        return $this->render('/home.html.twig');
    }

    public function signUp(): Response
    {
        return $this->render('user/registerUser.html.twig');
    }


    public function registerUser(Request $request): Response
    {
        $avatarPath = $this->imageService->moveImageToUploads($request->files->get('avatar_path'));
        $id = $this->userService->registerUser($request->get('first_name'), 
        $request->get('last_name'),
        $request->get('email'), 
        $request->get('phone'), $avatarPath);
        
        return $this->redirectToRoute('view_assortment', ['id' => $id], Response::HTTP_SEE_OTHER);    
    }
}