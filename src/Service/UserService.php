<?php
namespace App\Service;
use App\Repository\UserRepository;
use App\Entity\User;
use App\Service\Data\UserData;
use App\Service\UserServiceInterface;

class UserService implements UserServiceInterface
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function registerUser(string $firstName, string $lastName, string $email, ?string $phone, ?string $avatarPath): int 
    {
        $user = new User(
            null, 
            $firstName, 
            $lastName, 
            $email, 
            $phone, 
            $avatarPath);

        return $this->userRepository->store($user);
    }
}
?>
