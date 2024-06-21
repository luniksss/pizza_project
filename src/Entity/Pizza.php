<?php
declare(strict_types=1);
namespace App\Entity;

class Pizza
{
    public function __construct(
        private ?int $id,  
        private string $name,
        private string $description, 
        private int $price, 
        private string $picture)
        {
        }

        public function getPizzaId(): ?int
        {
            return $this->id;
        }

        public function getPizzaName(): string
        {
            return $this->name;
        }

        public function getPizzaDescription(): string
        {
            return $this->description;
        }

        public function getPizzaPrice(): int
        {
            return $this->price;
        }

        public function getPizzaPicture(): string
        {
            return $this->picture;
        }
}