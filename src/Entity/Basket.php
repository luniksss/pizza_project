<?php
declare(strict_types=1);
namespace App\Entity;

class Basket
{
    public function __construct(
        private ?int $id,
        private int $userId,  
        private int $pizzaName, 
        private int $pizzaPrice, 
        private string $address)
        {
        }

        public function getOrderId(): ?int
        {
            return $this->id;
        }

        public function getUserId(): int
        {
            return $this->userId;
        }

        public function getPizzaName(): int
        {
            return $this->pizzaName;
        }

        public function getPizzaPrice(): int
        {
            return $this->pizzaPrice;
        }

        public function getAddress(): string
        {
            return $this->address;
        }
}