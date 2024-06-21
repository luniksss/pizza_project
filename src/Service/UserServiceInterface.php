<?php
namespace App\Service;

interface UserServiceInterface
{
    public function registerUser(string $firstName, string $lastName, string $email, ?string $phone, ?string $avatarPath): int; 
}