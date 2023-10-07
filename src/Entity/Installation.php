<?php

namespace App\Entity;

use App\Repository\InstallationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InstallationRepository::class)]
class Installation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'installation', cascade: ['persist', 'remove'])]
    private ?Roof $idRoof = null;

    #[ORM\OneToMany(mappedBy: 'installation', targetEntity: Pannel::class)]
    private Collection $idPannel;

    #[ORM\Column(nullable: true)]
    private ?float $power = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbReqPann = null;

    #[ORM\Column(nullable: true)]
    private ?float $reqPow = null;

    #[ORM\Column(nullable: true)]
    private ?float $purcentEnergySaved = 0.7;

    public function __construct()
    {
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

    public function getNbReqPann(): ?int
    {
        return $this->nbReqPann;
    }

    public function setNbReqPann(?int $nbReqPann): static
    {
        $this->nbReqPann = $nbReqPann;

        return $this;
    }

    public function getReqPow(): ?float
    {
        return $this->reqPow;
    }

    public function setReqPow(?float $reqPow): static
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
}
