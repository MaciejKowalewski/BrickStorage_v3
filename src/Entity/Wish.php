<?php

namespace App\Entity;

use App\Repository\WishRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WishRepository::class)]
class Wish
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $SetId = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(length: 255)]
    private ?string $ImagePath = null;

    #[ORM\Column(length: 255)]
    private ?string $PromoklockiSRC = null;

    #[ORM\Column]
    private ?int $EolYear = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSetId(): ?string
    {
        return $this->SetId;
    }

    public function setSetId(string $SetId): static
    {
        $this->SetId = $SetId;

        return $this;
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

    public function getImagePath(): ?string
    {
        return $this->ImagePath;
    }

    public function setImagePath(string $ImagePath): static
    {
        $this->ImagePath = $ImagePath;

        return $this;
    }

    public function getPromoklockiSRC(): ?string
    {
        return $this->PromoklockiSRC;
    }

    public function setPromoklockiSRC(string $PromoklockiSRC): static
    {
        $this->PromoklockiSRC = $PromoklockiSRC;

        return $this;
    }

    public function getEolYear(): ?int
    {
        return $this->EolYear;
    }

    public function setEolYear(int $EolYear): static
    {
        $this->EolYear = $EolYear;

        return $this;
    }
}
