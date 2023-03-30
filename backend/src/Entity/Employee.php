<?php

declare(strict_types=1);

namespace App\Entity;

use Symfony\Component\Uid\Uuid;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[
    ORM\Entity(),
    ORM\Table(name: 'employee')
]
class Employee implements \JsonSerializable
{
    public function __construct(
        #[
            ORM\Id,
            ORM\Column(type: 'uuid')
        ]
        private readonly Uuid $id,
        #[ORM\Column(type: 'string', length: 120)]
        private string $fio,
        #[ORM\Column(type: 'string', length: 255)]
        private string $jobTitle,
        #[ORM\Column(type: 'string', length: 1000, nullable:true)]
        private string $description,
        #[ORM\Column(type: 'string', length: 255, nullable:true)]
        private string $short_description,
        #[ORM\Column(type: 'boolean')]
        private bool $is_active,
        #[ORM\ManyToMany(targetEntity:Department::class, inversedBy:"employees")]
        private ArrayCollection $departments,
    ) {}

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getActive(): bool
    {
        return $this->is_active;
    }

    public function setActive(bool $is_active): void
    {
        $this->is_active = $is_active;
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

    public function getDescription(): string
    {
        return $this->description ?? '';
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getShortDescription(): string
    {
        return $this->short_description ?? '';
    }

    public function setShortDescription(string $short_description): void
    {
        $this->short_description = $short_description;
    }

    public function getDepartments(): Collection
    {
        return $this->departments;
    }
    public function addDepartments(Department|null $department): self
    {
        if (!$this->departments->contains($department) && !is_null($department)) {
            $this->departments[] = $department;
        }
        return $this;
    }
    public function removeDepartments(Department|null $department): self
    {
        if(!is_null($department)){
            $this->departments->removeElement($department);
        }
        return $this;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id'                => $this->getId(),
            'fio'               => $this->getFIO(),
            'jobTitle'          => $this->getJobTitle(),
            'description'       => $this->getDescription(),
            'short_description' => $this->getShortDescription(),
            'departments'       => $this->getDepartments(),
        ];
    }
}
    