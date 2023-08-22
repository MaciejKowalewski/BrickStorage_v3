<?php

namespace App\Entity;

use App\Repository\MinifigureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MinifigureRepository::class)]
class Minifigure
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $minifigId = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column(length: 255)]
    private ?string $BricklinkSRC = null;

    #[ORM\Column(length: 255)]
    private ?string $ImagePath = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMinifigId(): ?string
    {
        return $this->minifigId;
    }

    public function setMinifigId(string $minifigId): static
    {
        $this->minifigId = $minifigId;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getBricklinkSRC(): ?string
    {
        return $this->BricklinkSRC;
    }

    public function setBricklinkSRC(string $BricklinkSRC): static
    {
        $this->BricklinkSRC = $BricklinkSRC;

        return $this;
    }

    public function getImagePath(): ?string
    {
        return $this->ImagePath;
    }

    public function setImagePath(string $ImagePath): static
    {
        $this->ImagePath = $ImagePath;

        return $this;
    }
}
