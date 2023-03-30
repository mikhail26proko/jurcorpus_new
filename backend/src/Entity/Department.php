<?php

declare(strict_types=1);

namespace App\Entity;

use Symfony\Component\Uid\Uuid;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[
    ORM\Entity(),
    ORM\Table(name: 'department')
]
class Department implements \JsonSerializable
{
    public function __construct(
        #[
            ORM\Id,
            ORM\Column(type: 'uuid')
        ]
        private readonly Uuid $id,
        #[ORM\Column(type: 'string', length: 120)]
        private string $name,
        #[ORM\Column(type: 'string', length: 255)]
        private string $adress,
        #[ORM\Column(type: 'string', length: 1000)]
        private string $description,
        #[ORM\Column(type: 'array', nullable:true)]
        private array $coordinates,
        #[ORM\ManyToMany(targetEntity:Employee::class, mappedBy:"departments")]
        private ArrayCollection $employees,
    ) {}

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getAdress(): string
    {
        return $this->adress ?? '';
    }

    public function setAdress(string $adress): void
    {
        $this->adress = $adress;
    }

    public function getDescription(): string
    {
        return $this->description ?? '';
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getCoordinates(): array
    {
        return $this->coordinates ?? [];
    }

    public function setCoordinates(array $coordinates): void
    {
        $this->coordinates = $coordinates;
    }

    public function getEmployyes(): Collection
    {
        return $this->employees;
    }
    public function addEmployees(Employee|null $employee): self
    {
        if (!$this->employees->contains($employee) && !is_null($employee)) {
            $this->employees[] = $employee;
        }
        return $this;
    }
    public function removeEmployees(Employee|null $employee): self
    {
        if (!is_null($employee)){
            $this->employees->removeElement($employee);
        }
        return $this;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id'                => $this->getId(),
            'name'              => $this->getName(),
            'adress'            => $this->getAdress(),
            'description'       => $this->getDescription(),
            'coordinates'       => $this->getCoordinates(),
            'supervisor'        => '',
            'employees'         => $this->getEmployyes(),
        ];
    }
}
