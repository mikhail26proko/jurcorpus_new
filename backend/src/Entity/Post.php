<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\User;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use App\Repository\PostRepository;

#[
    ORM\Entity(repositoryClass: PostRepository::class),
    ORM\Table(name: '"post"')
]
class Post implements \JsonSerializable
{
    public function __construct(
        #[
            ORM\Id,
            ORM\Column(type: 'uuid')
        ]
        private readonly Uuid $id,
        #[ORM\Column(type: 'string', length: 100)]
        private string $title,
        #[ORM\Column(type: 'string', length: 1000)]
        private string $text,
        #[ORM\Column(type: 'string', length: 120, nullable:true)]
        private string|null $image,
        #[ORM\Column(type: 'boolean')]
        private bool $active,
        #[
            ORM\ManyToOne(targetEntity:'User'),
            ORM\JoinColumn(name:'user_id', referencedColumnName:'id', nullable:true)
        ]
        private readonly User|null $user,
        #[ORM\Column(type: 'datetime_immutable')]
        private readonly DateTimeImmutable $createdAt,
        #[ORM\Column(type: 'datetime_immutable')]
        private DateTimeImmutable $updatedAt,
    ) {}

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
        $this->update();
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
        $this->update();
    }

    public function getImage(): string|null
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
        $this->update();
    }

    public function getUser(): User|null
    {
        return $this->user;
    }

    public function getIsActive(): bool
    {
        return $this->active;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
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
            'text  '    => $this->getText(),
            'image'     => $this->getImage(),
            'status'    => $this->getIsActive(),
            'user'      => $this->getUser(),
            'createdAt' => $this->getCreatedAt(),
            'updatedAt' => $this->getUpdatedAt(),
        ];
    }

    public function update(): void
    {
        $this->updatedAt = new \DateTimeImmutable('now');
    }

    public function setStatus(bool $active): void
    {
        $this->active = $active;
        $this->update();
    }
}
