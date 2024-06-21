<?php
declare(strict_types=1);
namespace App\Controller;

use App\Service\ProductsServiceInterface;
use App\Service\ImageServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class StorefrontController extends AbstractController
{
    private ImageServiceInterface $imageService;
    private ProductsServiceInterface $productsService;
    public function __construct(ProductsServiceInterface $productsService, ImageServiceInterface $imageService)
    {
       $this->productsService = $productsService;
       $this->imageService = $imageService;
    }

    public function index(int $id): Response
    {
        $products = $this->productsService->list();
        return $this->render('assortment/allProducts.html.twig', [
            'product_list' => $products, 'user_id' => $id
         ]);
    }

    public function editCatalog(): Response
    {
        $products = $this->productsService->list();
        return $this->render('assortment/productsCatalog.html.twig', [
            'product_list' => $products
         ]);
    }

    public function deleteProduct(Request $request): Response
    {
        $this->imageService->deleteFileFromUploads($request->get('picture'));
        $this->productsService->delete(intval($request->get('pizza_id')));
        return $this->redirectToRoute('admin', [], Response::HTTP_SEE_OTHER); 
    }
}