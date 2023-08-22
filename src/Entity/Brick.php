<?php

namespace App\Entity;

use App\Repository\BrickRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BrickRepository::class)]
class Brick
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column]
    private ?string $BrickId = null;

    #[ORM\Column]
    private ?int $Quantity = null;

    #[ORM\Column(length: 255)]
    private ?string $BricklinkSRC = null;

    #[ORM\Column(length: 255)]
    private ?string $ImagePath = null;

    #[ORM\Column(length: 255)]
    private ?string $Color = null;

    #[ORM\Column(length: 255)]
    private ?string $PartType = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    public function getBrickId(): ?string
    {
        return $this->BrickId;
    }

    public function setBrickId(string $BrickId): static
    {
        $this->BrickId = $BrickId;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->Quantity;
    }

    public function setQuantity(int $Quantity): static
    {
        $this->Quantity = $Quantity;

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

    public function getColor(): ?string
    {
        return $this->Color;
    }

    public function setColor(string $Color): static
    {
        $this->Color = $Color;

        return $this;
    }

    public function getPartType(): ?string
    {
        return $this->PartType;
    }

    public function setPartType(string $PartType): static
    {
        $this->PartType = $PartType;

        return $this;
    }
}
