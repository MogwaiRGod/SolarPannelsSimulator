<?php

namespace App\Entity;

use App\Repository\PannelRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PannelRepository::class)]
class Pannel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // en m
    #[ORM\Column(nullable: true)]
    private static ?float $length = 1.555;

    // en m
    #[ORM\Column(nullable: true)]
    private static ?float $width = 1.038;

    // en Wc 
    #[ORM\Column(nullable: true)]
    private static ?float $power = 375;

    #[ORM\ManyToOne(inversedBy: 'idPannel')]
    private ?Installation $installation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public static function getLength(): ?float
    {
        return self::$length;
    }

    public function setLength(?float $length): static
    {
        $this->length = $length;

        return $this;
    }

    public static function getWidth(): ?float
    {
        return self::$width;
    }

    public function setWidth(?float $width): static
    {
        $this->width = $width;

        return $this;
    }

    public static function getPower(): ?float
    {
        return self::$power;
    }

    public function setPower($power): static
    {
        $this->power = $power;

        return $this;
    }

    public function getInstallation(): ?Installation
    {
        return $this->installation;
    }

    public function setInstallation(?Installation $installation): static
    {
        $this->installation = $installation;

        return $this;
    }
}
