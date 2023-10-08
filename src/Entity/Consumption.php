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

    // montant de la facture énergétique annuelle
    #[ORM\Column(nullable: true)]
    private ?float $bill = null;

    // consommation annuelle en kWh
    #[ORM\Column(nullable: true)]
    private ?float $energy = null;

    // prix du kWh (en €)
    #[ORM\Column(nullable: true)]
    private static $energyPrice = 0.2;

    // estimation de l'économie d'énergie
    #[ORM\Column(nullable: true)]
    private ?float $energySaved = null;

    #[ORM\OneToOne(mappedBy: 'idConsumption', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    public function __construct(?float $bll = null, ?User $usr = null)
    {
        $this->bill = $bll;
        $this->user = $usr;
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

    public function getEnergySaved(): ?float
    {
        return $this->energySaved;
    }

    public function setEnergySaved(?float $energySaved): static
    {
        $this->energySaved = $energySaved;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setIdConsumption(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getIdConsumption() !== $this) {
            $user->setIdConsumption($this);
        }

        $this->user = $user;

        return $this;
    }
}
