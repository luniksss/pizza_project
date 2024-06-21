<?php
namespace App\Service;

interface OrdersServiceInterface
{
    public function placeOrder(int $userId, int $pizzaName, int $pizzaPrice, string $address): void; 
}