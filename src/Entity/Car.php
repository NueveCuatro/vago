<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'garage')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Garage $garage = null;

    #[ORM\ManyToMany(targetEntity: Brand::class, inversedBy: 'cars')]
    private Collection $brand;

    public function __construct()
    {
        $this->brand = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGarage(): ?Garage
    {
        return $this->garage;
    }

    public function setGarage(?Garage $garage): self
    {
        $this->garage = $garage;

        return $this;
    }

    /**
     * @return Collection<int, Brand>
     */
    public function getBrand(): Collection
    {
        return $this->brand;
    }

    public function addBrand(Brand $brand): self
    {
        if (!$this->brand->contains($brand)) {
            $this->brand->add($brand);
        }

        return $this;
    }

    public function removeBrand(Brand $brand): self
    {
        $this->brand->removeElement($brand);

        return $this;
    }
}
