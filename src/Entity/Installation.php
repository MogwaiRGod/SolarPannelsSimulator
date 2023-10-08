<?php

namespace App\Entity;

use App\Repository\InstallationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Pannel;

#[ORM\Entity(repositoryClass: InstallationRepository::class)]
class Installation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'installation', cascade: ['persist', 'remove'])]
    private ?Roof $idRoof = null;

    // les panneaux que l'installation peut contenir
    #[ORM\OneToMany(mappedBy: 'installation', targetEntity: Pannel::class)]
    private Collection $idPannel;

    // puissance de l'installation
    #[ORM\Column(nullable: true)]
    private ?float $power = null;

    // puissance recommandée du système en kWc
    #[ORM\Column(nullable: true)]
    private ?int $reqPow = null;

    // nombre de panneaux requis
    #[ORM\Column(nullable: true)]
    private ?int $nbReqPann = null;

    // 70% (pour 70% d'économie d'énergie)
    #[ORM\Column(nullable: true)]
    private static ?float $purcentEnergySaved = 0.7;

    // production idéale de l'installation en kWh
    #[ORM\Column(nullable: true)]
    private ?float $idealProduction = null;

    // nombre de panneaux maximum que la toiture peut contenir
    #[ORM\Column(nullable: true)]
    private ?int $nbPannMax = null;

    public function __construct(?Roof $rf)
    {
        $this->idRoof = $rf;
        $this->idealProduction = $this->calculateIdealProduction();
        $this->reqPow = $this->calculateReqPow();
        $this->nbReqPann = $this->calculateNbReqPann();
        $this->nbPannMax = $this->calculateNbPannMax();
        $this->idPannel = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, Pannel>
     */
    public function getIdPannel(): Collection
    {
        return $this->idPannel;
    }

    public function addIdPannel(Pannel $idPannel): static
    {
        if (!$this->idPannel->contains($idPannel)) {
            $this->idPannel->add($idPannel);
            $idPannel->setInstallation($this);
        }

        return $this;
    }

    public function removeIdPannel(Pannel $idPannel): static
    {
        if ($this->idPannel->removeElement($idPannel)) {
            // set the owning side to null (unless already changed)
            if ($idPannel->getInstallation() === $this) {
                $idPannel->setInstallation(null);
            }
        }

        return $this;
    }

    public function getPower(): ?float
    {
        return $this->power;
    }

    public function setPower(?float $power): static
    {
        $this->power = $power;

        return $this;
    }

    private function calculateReqPow(): ?int
    {
        if (!is_null($this->idealProduction)) {
            return (int)($this->idealProduction / 1460);
        }

        return null;
    }

    public function getReqPow(): ?float
    {
        return $this->reqPow;
    }

    /**
     * @return ?int
     * 
     * méthode retournant la puissance de l'installation en Wc
     */
    public function getReqPowWc(): ?int
    {
        if (!is_null($this->reqPow)) {
            return $this->reqPow * 1000;
        }
        
        return null;
    }

    public function setReqPow(?int $reqPow): static
    {
        $this->reqPow = $reqPow;

        return $this;
    }

    public function getPurcentEnergySaved(): ?float
    {
        return $this->purcentMonSaved;
    }

    public function setPurcentEnergySaved(?float $purcentMonSaved): static
    {
        $this->purcentMonSaved = $purcentMonSaved;

        return $this;
    }

    /**
     * @return ?float : production idéale arrondi à 2 décimales après la virgule
     */
    private function calculateIdealProduction(): ?float
    {
        if (!is_null($this->idRoof)) {
            return round($this->idRoof->getUser()->getIdConsumption()->getEnergy() * self::$purcentEnergySaved);
        }

        return null;
    }

    public function getIdealProduction(): ?float
    {
        return $this->idealProduction;
    }

    public function setIdealProduction(?float $idealProduction): static
    {
        $this->idealProduction = $idealProduction;

        return $this;
    }

    /**
     * méthode retournant le nombre de panneaux requis pour faire 70% d'économies d'énergie
     * 
     * @return ?int
     */
    private function calculateNbReqPann(): ?int
    {
        if (!is_null($this->reqPow)) {
            return round($this->getReqPowWc() / Pannel::getPower());
        }

        return null;
    }

    public function getNbReqPann(): ?int
    {
        return $this->nbReqPann;
    }

    public function setNbReqPann(?int $nbReqPann): static
    {
        $this->nbReqPann = $nbReqPann;

        return $this;
    }

    /**
     * @return int : nombre de panneaux maximum que la toiture peut accueillir
     */
    private function calculateNbPannMax(): int
    {
        $tmpNbReqPann = $this->nbReqPann;

        while (Pannel::getWidth() * Pannel::getLength() * $tmpNbReqPann > $this->idRoof->getArea()) {
            $tmpNbReqPann--;
        }

        return $tmpNbReqPann;
    }

    public function getNbPannMax(): ?int
    {
        return $this->nbPannMax;
    }

    public function setNbPannMax(?int $nbPannMax): static
    {
        $this->nbPannMax = $nbPannMax;

        return $this;
    }
}
