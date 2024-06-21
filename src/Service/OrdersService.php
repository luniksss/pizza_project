<?php
namespace App\Service;

use App\Entity\Basket;
use App\Repository\OrdersRepository;
use App\Service\OrdersServiceInterface;

class OrdersService implements OrdersServiceInterface
{
    private OrdersRepository $ordersRepository;

    public function __construct(OrdersRepository $ordersRepository)
    {
        $this->ordersRepository = $ordersRepository;
    }

    public function placeOrder(int $userId, int $pizzaName, int $pizzaPrice, string $address): void 
    {
        $order = new Basket(
            null, 
            $userId, 
            $pizzaName, 
            $pizzaPrice, 
            $address);

        $orderId = $this->ordersRepository->store($order);    
    }
}