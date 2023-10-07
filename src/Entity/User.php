<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $firstName = null;

    #[ORM\OneToOne(inversedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Roof $idRoof = null;

    #[ORM\OneToOne(inversedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Consumption $idConsumption = null;

    public function __construct(?string $frstNm = null, ?string $lstNm = null, ?Roof $rf = null, ?Consumption $idConsumption = null)
    {
        $this->lastName = $lstNm;
        $this->firstName = $frstNm;
        $this->idRoof = $rf;
        $this->idConsumption = $idConsumption;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getIdRoof(): ?Roof
    {
        return $this->idRoof;
    }

    public function setIdRoof(?Roof $idRoof): static
    {
        $this->idRoof = $idRoof;

        return $this;
    }

    public function getIdConsumption(): ?Consumption
    {
        return $this->idConsumption;
    }

    public function setIdConsumption(?Consumption $idConsumption): static
    {
        $this->idConsumption = $idConsumption;

        return $this;
    }
}
