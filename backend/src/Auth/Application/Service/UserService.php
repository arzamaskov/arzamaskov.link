<?php

namespace App\Auth\Application\Service;

use App\Users\Domain\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService
{
    private EntityManagerInterface $emtityManager;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher
    ) {
        $this->emtityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
    }

    public function registerUser(string $email, string $plainPassword): User
    {
        $user = new User($email, '');

        $hashedPassword = $this->passwordHasher->hashPassword($user, $plainPassword);
        $user->setPassword($hashedPassword);

        $this->emtityManager->persist($user);
        $this->emtityManager->flush();
    }
}
