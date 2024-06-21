<?php
namespace App\Service;

use App\Entity\Pizza;
use App\Repository\ProductsRepository;
use App\Service\ProductsServiceInterface;

class ProductsService implements ProductsServiceInterface
{
    private ProductsRepository $productsRepository;

    public function __construct(ProductsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }

    public function list(): array
    {
        $products = $this->productsRepository->listAll();
        $productsList = [];
        foreach ($products as $product)
        {
            $productsList[] = [
                'id' => $product->getPizzaId(),
                'name' => $product->getPizzaName(),
                'description' => $product->getPizzaDescription(),
                'price' => $product->getPizzaPrice(),
                'picture' => $product->getPizzaPicture(),
            ];
        }

        return $productsList;
    }

    public function add(string $name, string $description, string $price, string $picture): void
    {
        $pizza = new Pizza(
            null, 
            $name, 
            $description, 
            $price,
            $picture);

        $this->productsRepository->store($pizza);
    }

    public function delete(int $id): void
    {
        $pizza = $this->productsRepository->findById($id);
        $this->productsRepository->delete($pizza);
    }
}