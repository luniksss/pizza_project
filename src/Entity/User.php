<?php
declare(strict_types=1);
namespace App\Entity;

class User
{
    public function __construct(
        private ?int $id,  
        private string $firstName, 
        private string $lastName, 
        private string $email, 
        private ?string $phone, 
        private string $role,
        private ?string $avatarPath,
        private string $password)
        {
        }

        public function getUserId(): ?int
        {
            return $this->id;
        }

        public function getFirstName(): string
        {
            return $this->firstName;
        }

        public function getLastName(): string
        {
            return $this->lastName;
        }
        public function getEmail(): string
        {
            return $this->email;
        }
        public function getPhone(): ?string
        {
            return $this->phone;
        }

        public function getRole(): string
        {
            return $this->role;
        }
        
        public function getAvatarPath(): ?string
        {
            return $this->avatarPath;
        }

    
        public function getPassword(): string
        {
            return $this->password;
        }

        public function setFirstName(string $firstName): void
        {
                $this->firstName = $firstName;
        }

        public function setLastName(string $lastName): void
        {
            $this->lastName = $lastName;
        }
        
        public function setEmail(string $email): void
        {
            $this->email = $email;
        }

        public function setPhone(string $phone): void
        {
            $this->phone = $phone;
        }

        public function setAvatarPath(string $avatarPath): void
        {
                $this->avatarPath = $avatarPath;
        }

        public function setPassword(string $password): void
        {
            $this->password = $password;
        }
}