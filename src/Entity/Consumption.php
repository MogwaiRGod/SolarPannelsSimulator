<?php

namespace App\Entity;

use App\Repository\ConsumptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConsumptionRepository::class)]
class Consumption
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?float $bill = null;

    #[ORM\Column(nullable: true)]
    private ?float $energy = null;

    #[ORM\Column(nullable: true)]
    public static $energyPrice = 0.2;

    #[ORM\Column(nullable: true)]
    private ?float $energySaved = null;

    public function __construct(?float $bll = null)
    {
        $this->bill = $bll;
        $this->energy = $this->calculateEnergy();
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBill(): ?float
    {
        return $this->bill;
    }

    public function setBill(?float $bill): static
    {
        $this->bill = $bill;

        return $this;
    }

    public function getEnergy(): ?float
    {
        return $this->energy;
    }
    
    /**
     * @return ?float
     * 
     * Méthode calculant la consommation d'énergie du client en kWh
     * selon sa facture d'éléctricité en €
     */
    private function calculateEnergy(): ?float
    {
        if (!is_null($this->bill)) {
            return $this->bill/self::$energyPrice;
        }

        return null;
    }

    public function setEnergy(?float $energy): static
    {
        $this->energy = $energy;

        return $this;
    }

    public function getEnergyPrice(): ?float
    {
        return $this->energyPrice;
    }

    public function setEnergyPrice(?float $energyPrice): static
    {
        $this->energyPrice = $energyPrice;

        return $this;
    }

    public function geteEnergySaved(): ?float
    {
        return $this->energySaved;
    }

    public function setEnergySaved(?float $energySaved): static
    {
        $this->energySaved = $energySaved;

        return $this;
    }
}
