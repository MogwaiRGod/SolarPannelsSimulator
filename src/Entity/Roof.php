<?php

namespace App\Entity;

use App\Repository\RoofRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoofRepository::class)]
class Roof
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?float $length = null;

    #[ORM\Column(nullable: true)]
    private ?float $width = null;

    #[ORM\Column(nullable: true)]
    private ?float $area = null;

    #[ORM\OneToOne(mappedBy: 'idRoof', cascade: ['persist', 'remove'])]
    private ?Installation $installation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLength(): ?float
    {
        return $this->length;
    }

    public function setLength(?float $length): static
    {
        $this->length = $length;

        return $this;
    }

    public function getWidth(): ?float
    {
        return $this->width;
    }

    public function setWidth(?float $width): static
    {
        $this->width = $width;

        return $this;
    }

    public function getArea(): ?float
    {
        return $this->area;
    }

    public function setArea(?float $area): static
    {
        $this->area = $area;

        return $this;
    }

    public function getInstallation(): ?Installation
    {
        return $this->installation;
    }

    public function setInstallation(?Installation $installation): static
    {
        // unset the owning side of the relation if necessary
        if ($installation === null && $this->installation !== null) {
            $this->installation->setIdRoof(null);
        }

        // set the owning side of the relation if necessary
        if ($installation !== null && $installation->getIdRoof() !== $this) {
            $installation->setIdRoof($this);
        }

        $this->installation = $installation;

        return $this;
    }
}
