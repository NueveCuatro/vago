<?php

namespace App\Entity;

use App\Repository\BrandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BrandRepository::class)]
class Brand
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'subBrands')]
    private ?self $parent = null;

    #[ORM\OneToMany(mappedBy: 'parent', targetEntity: self::class)]
    private Collection $subBrands;

    #[ORM\ManyToMany(targetEntity: Car::class, mappedBy: 'brand')]
    private Collection $cars;

    public function __construct()
    {
        $this->subBrands = new ArrayCollection();
        $this->cars = new ArrayCollection();
    }

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

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getSubBrands(): Collection
    {
        return $this->subBrands;
    }

    public function addSubBrand(self $subBrand): self
    {
        if (!$this->subBrands->contains($subBrand)) {
            $this->subBrands->add($subBrand);
            $subBrand->setParent($this);
        }

        return $this;
    }

    public function removeSubBrand(self $subBrand): self
    {
        if ($this->subBrands->removeElement($subBrand)) {
            // set the owning side to null (unless already changed)
            if ($subBrand->getParent() === $this) {
                $subBrand->setParent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Car>
     */
    public function getCars(): Collection
    {
        return $this->cars;
    }

    public function addCar(Car $car): self
    {
        if (!$this->cars->contains($car)) {
            $this->cars->add($car);
            $car->addBrand($this);
        }

        return $this;
    }

    public function removeCar(Car $car): self
    {
        if ($this->cars->removeElement($car)) {
            $car->removeBrand($this);
        }

        return $this;
    }
}
