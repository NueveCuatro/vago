<?php

namespace App\Entity;

use App\Repository\PiloteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PiloteRepository::class)]
class Pilote
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToOne(inversedBy: 'pilote', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: true)]
    private ?Garage $pilote = null;

    #[ORM\OneToOne(mappedBy: 'createur', cascade: ['persist', 'remove'])]
    private ?Gallery $gallery = null;

    #[ORM\OneToOne(inversedBy: 'pilote', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Garage $garage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPilote(): ?Garage
    {
        return $this->pilote;
    }

    public function setPilote(Garage $pilote): self
    {
        $this->pilote = $pilote;

        return $this;
    }

    public function getGallery(): ?Gallery
    {
        return $this->gallery;
    }

    public function setGallery(Gallery $gallery): self
    {
        // set the owning side of the relation if necessary
        if ($gallery->getCreateur() !== $this) {
            $gallery->setCreateur($this);
        }

        $this->gallery = $gallery;

        return $this;
    }

    public function __toString() {
        return $this->name;
    }

    public function getGarage(): ?Garage
    {
        return $this->garage;
    }

    public function setGarage(Garage $garage): self
    {
        $this->garage = $garage;

        return $this;
    }
}
