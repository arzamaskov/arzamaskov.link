<?php

namespace App\Users\Domain\Entity;

use App\Shared\Domain\Service\UlidService;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name: 'users_user')]
class User
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 26)]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    private string $ulid;

    #[ORM\Column(type: 'string')]
    private string $email;

    #[ORM\Column(type: 'string')]
    private string $password;

    public function __construct(string $email, string $password)
    {
        $this->ulid = UlidService::generate();
        $this->email = $email;
        $this->password = $password;
    }

    public function getUlid(): string
    {
        return $this->ulid;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
