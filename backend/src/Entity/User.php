<?php

declare(strict_types=1);

namespace App\Entity;

use Symfony\Component\Uid\Uuid;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[
    ORM\Entity(repositoryClass: UserRepository::class),
    ORM\Table(name: '"user"')
]
class User implements UserInterface, PasswordAuthenticatedUserInterface, \JsonSerializable
{
    public function __construct(
        #[
            ORM\Id,
            ORM\Column(type: 'uuid')
        ]
        private readonly Uuid $id,
        #[ORM\Column(type: 'string', length: 25, unique:true)]
        private readonly string $login,
        #[ORM\Column(type: 'string', length: 255)]
        private string $fio,
        #[ORM\Column(type: 'string', length: 255, nullable:true)]
        private string $jobTitle,
        #[ORM\Column(type: 'array', nullable:true)]
        private array $description,
        #[ORM\Column(type: 'boolean')]
        private bool $isPublic,
        #[ORM\Column(type: 'string', length: 60)]
        private string $password,
        #[ORM\Column(type: 'json')]
        private array $roles = [],
    ) {}

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getIsPublic(): bool
    {
        return $this->isPublic;
    }

    public function setIsPublic(bool $isPublic): void
    {
        $this->isPublic = $isPublic;
    }

    public function getFIO(): string
    {
        return $this->fio;
    }

    public function setFIO(string $fio): void
    {
        $this->fio = $fio;
    }

    public function getJobTitle(): string
    {
        return $this->jobTitle ?? '';
    }

    public function setJobTitle(string $jobTitle): void
    {
        $this->jobTitle = $jobTitle;
    }

    public function getDescription(): array
    {
        return $this->description ?? [];
    }

    public function setDescription(array $description): void
    {
        $this->description = $description;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getUserIdentifier(): string
    {
        return $this->login;
    }

    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id'            => $this->getId(),
            'login'         => $this->getLogin(),
            'fio'           => $this->getFIO(),
            'jobTitle'      => $this->getJobTitle(),
            'description'   => $this->getDescription(),
        ];
    }
}
