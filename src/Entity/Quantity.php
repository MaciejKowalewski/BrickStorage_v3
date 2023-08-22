<?php

namespace App\Entity;

use App\Repository\QuantityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\Brick;
use App\Entity\Minifigure;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuantityRepository::class)]
class Quantity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $Quantity = null;

    #[ORM\ManyToOne(targetEntity: Minifigure::class)]
    private Minifigure $MinifigureID;

    #[ORM\ManyToOne(targetEntity: Brick::class)]
    private Brick $BrickID;

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return mixed $MinifigureID
     */
    public function getMinifigureID()
    {
        return $this->MinifigureID;
    }

    /**
     * @return mixed $MinifigureID
     */
    public function setMinifigureID($MinifigureID): void
    {
        $this->MinifigureID = $MinifigureID;
    }

    /**
     * @return mixed $BrickID
     */
    public function getBrickID()
    {
        return $this->BrickID;
    }

    /**
     * @return mixed $BrickID
     */
    public function setBrickID($BrickID): void
    {
        $this->BrickID = $BrickID;
    }
}
