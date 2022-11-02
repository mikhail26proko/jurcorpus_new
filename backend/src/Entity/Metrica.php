<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\User;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity]
#[ORM\Table(name: '"metrica"')]
class Metrica implements \JsonSerializable
{
    public function __construct(
        #[
            ORM\Id,
            ORM\Column(type: 'uuid')
        ]
        private readonly Uuid $id,
        #[ORM\Column(type: 'string', length: 100)]
        private readonly string $title,
        #[
            ORM\ManyToOne(targetEntity:'User'),
            ORM\JoinColumn(name:'user_id', referencedColumnName:'id')
        ]
        private readonly User $user,
        #[ORM\Column(type: 'datetime_immutable')]
        private readonly DateTimeImmutable $updatedAt,
    ) {}

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id'        => $this->getId(),
            'title'     => $this->getTitle(),
            'user'      => $this->getUser(),
            'updatedAt' => $this->getUpdatedAt(),
        ];
    }
}
