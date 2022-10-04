<?php

namespace App\Entity;

use App\Repository\GarageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GarageRepository::class)]
class Garage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'garage', targetEntity: Car::class, orphanRemoval: true)]
    private Collection $garage;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToOne(mappedBy: 'pilote', cascade: ['persist', 'remove'])]
    private ?Pilote $pilote = null;

    public function __construct()
    {
        $this->garage = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Car>
     */
    public function getGarage(): Collection
    {
        return $this->garage;
    }

    public function addGarage(Car $car): self
    {
        if (!$this->garage->contains($car)) {
            $this->garage->add($car);
            $car->setGarage($this);
        }

        return $this;
    }

    public function removeGarage(Car $car): self
    {
        if ($this->garage->removeElement($car)) {
            // set the owning side to null (unless already changed)
            if ($car->getGarage() === $this) {
                $car->setGarage(null);
            }
        }

        return $this;
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

    public function getPilote(): ?Pilote
    {
        return $this->pilote;
    }

    public function setPilote(Pilote $pilote): self
    {
        // set the owning side of the relation if necessary
        if ($pilote->getPilote() !== $this) {
            $pilote->setPilote($this);
        }

        $this->pilote = $pilote;

        return $this;
    }
}
