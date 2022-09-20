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

    public function addGarage(Car $garage): self
    {
        if (!$this->garage->contains($garage)) {
            $this->garage->add($garage);
            $garage->setGarage($this);
        }

        return $this;
    }

    public function removeGarage(Car $garage): self
    {
        if ($this->garage->removeElement($garage)) {
            // set the owning side to null (unless already changed)
            if ($garage->getGarage() === $this) {
                $garage->setGarage(null);
            }
        }

        return $this;
    }
}
