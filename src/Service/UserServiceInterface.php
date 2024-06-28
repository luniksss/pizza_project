<?php
namespace App\Service;

interface UserServiceInterface
{
    public function registerUser(string $firstName, string $lastName, string $email, ?string $phone, string $role, string $password, ?string $avatarPath): int; 
    public function authentication(string $email, string $password): int;
}