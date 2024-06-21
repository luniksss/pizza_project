<?php
namespace App\Service;

interface ProductsServiceInterface
{
    public function list(): array;
    public function add(string $name, string $description, string $price, string $picture): void; 
    public function delete(int $id): void;
}