<?php
namespace App\Service;
use App\Repository\UserRepository;
use App\Entity\User;
use App\Entity\UserRole;
use App\Service\Data\UserData;
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

    public function authentication(string $email, string $password): ?UserData {
        $user = $this->userRepository->findByEmail($email);
        $existingUser = new UserData(
            $user->getUserId(),
            $user->getFirstName(),
            $user->getLastName(),
            $user->getEmail(),
            $user->getPhone(),
            $user->getRole(),
            $user->getAvatarPath(),);
        $checkPassword = $this->passwordHasher->hash($password);
        $rightPassword = $user->getPassword();
        if (($existingUser !== null) and ($checkPassword === $rightPassword))
        {
                return $existingUser;
        }
        return null;
    }

    public function viewUser($email): ?UserData
    {
        $user = $this->userRepository->findByEmail($email);
        return ($user === null) ? null: new UserData(
            $user->getUserId(),
            $user->getFirstName(),
            $user->getLastName(),
            $user->getEmail(),
            $user->getPhone(),
            $user->getRole(),
            $user->getAvatarPath(),
        );
    }
}
?>
