<?php
declare(strict_types=1);
namespace App\Controller;

use App\Service\ProductsServiceInterface;
use App\Service\ImageServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class AddPizzaController extends AbstractController
{
    private ProductsServiceInterface $productsService;
    private ImageServiceInterface $imageService;
    public function __construct(ProductsServiceInterface $productsService, ImageServiceInterface $imageService)
    {
       $this->productsService = $productsService;
       $this->imageService = $imageService;
    }

    public function index(): Response
    {
        return $this->render('assortment/addProduct.html.twig');
    }

    public function add(Request $request): Response
    {
        $avatarPath = $this->imageService->moveImageToUploads($request->files->get('picture'));
        $this->productsService->add(
            $request->get('name'), 
            $request->get('description'),
            $request->get('price'), 
            $avatarPath);
        
        return $this->redirectToRoute('admin', [], Response::HTTP_SEE_OTHER);    
    }
}