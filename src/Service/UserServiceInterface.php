<?php
namespace App\Service;

use App\Service\Data\UserData;

interface UserServiceInterface
{
    public function registerUser(string $firstName, string $lastName, string $email, ?string $phone, string $role, string $password, ?string $avatarPath): int; 
    public function authentication(string $email, string $password): ?UserData;
    public function viewUser($email): ?UserData;
}