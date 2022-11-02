<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\User;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use App\Repository\LeadRepository;

#[
    ORM\Entity(repositoryClass: LeadRepository::class),
    ORM\Table(name: '"lead"')
]
class Lead implements \JsonSerializable
{
    public function __construct(
        #[
            ORM\Id,
            ORM\Column(type: 'uuid')
        ]
        private readonly Uuid $id,
        #[ORM\Column(type: 'string', length: 100)]
        private readonly string $name,
        #[ORM\Column(type: 'string', length: 1000)]
        private readonly string $text,
        #[ORM\Column(type: 'string', length: 120)]
        private readonly string $contact,
        #[ORM\Column(type: 'string', length: 50)]
        private string $status,
        #[ORM\Column(type: 'array', nullable:true)]
        private iterable $history,
        #[
            ORM\ManyToOne(targetEntity:'User'),
            ORM\JoinColumn(name:'user_id', referencedColumnName:'id', nullable:true)
        ]
        private User|null $responsible,
        #[ORM\Column(type: 'datetime_immutable')]
        private readonly DateTimeImmutable $createdAt,
        #[ORM\Column(type: 'datetime_immutable')]
        private DateTimeImmutable $updatedAt,
    ) {}

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getHistory(): iterable
    {
        return $this->history;
    }

    public function addHistory(string $history): void
    {
        $this->history[] = $history;
        $this->update();
    }

    public function getContact(): string
    {
        return $this->contact;
    }

    public function getUser(): User|null
    {
        return $this->responsible;
    }

    public function setUser(User $responsible): void
    {
        $this->responsible = $responsible;
        $this->update();
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
        $this->update();
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
            'name'      => $this->getName(),
            'text  '    => $this->getText(),
            'contact'   => $this->getContact(),
            'user'      => $this->getUser(),
            'status'    => $this->getStatus(),
            'createdAt' => $this->getCreatedAt(),
            'updatedAt' => $this->getUpdatedAt(),
        ];
    }

    public function update(): void
    {
        $this->updatedAt = new \DateTimeImmutable('now');
    }
}
