<?php
namespace App\Service;
use App\Repository\UserRepository;
use App\Entity\User;
use App\Entity\UserRole;
use App\Service\UserServiceInterface;

class UserService implements UserServiceInterface
{
    private UserRepository $userRepository;
    private PasswordHasher $passwordHasher;

    public function __construct(UserRepository $userRepository, PasswordHasher $passwordHasher)
    {
        $this->userRepository = $userRepository;
        $this->passwordHasher = $passwordHasher;
    }

    public function registerUser(string $firstName, string $lastName, string $email, ?string $phone, string $role, string $password, ?string $avatarPath): int 
    {
        $existingUser = $this->userRepository->findByEmail($email);
        if ($existingUser !== null)
        {
            throw new \InvalidArgumentException("User with email " . $email . " already has been registered");
        }
        if (!UserRole::isValid($role))
        {
            throw new \InvalidArgumentException("Role is not valid " . $role);
        }

        var_dump($avatarPath);
        $user = new User(
            null, 
            $firstName, 
            $lastName, 
            $email, 
            $phone, 
            $role,
            $avatarPath,
            $this->passwordHasher->hash($password));

        return $this->userRepository->store($user);
    }

    public function authentication(string $email, string $password): int {
        $existingUser = $this->userRepository->findByEmail($email);
        $checkPassword = $this->passwordHasher->hash($password);
        $rightPassword = $existingUser->getPassword();
        var_dump($rightPassword, $checkPassword);
        if (($existingUser !== null) and ($checkPassword === $rightPassword))
        {
                return $existingUser->getRole();
        }
        return 0;
    }
}
?>
