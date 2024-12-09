<?php

namespace App\Users\Infrastructure\Repository;

use App\Users\Domain\Entity\User;
use App\Users\Domain\Repository\UserRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<object>
 */
class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    private EntityManagerInterface $em;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $em)
    {
        parent::__construct($registry, User::class);
        $this->em = $em;
    }

    public function add(User $user): void
    {
        $this->em->persist($user);
        $this->em->flush();
    }

    public function findByUlid(string $ulid): User
    {
        return $this->find($ulid);
    }
}
