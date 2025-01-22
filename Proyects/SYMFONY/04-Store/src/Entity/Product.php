<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $amount = null;

    /**
     * @var Collection<int, Change>
     */
    #[ORM\OneToMany(targetEntity: Change::class, mappedBy: 'product')]
    private Collection $changes;

    #[ORM\ManyToOne(inversedBy: 'products')]
    private ?Location $location = null;

    public function __construct()
    {
        $this->changes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function addProduct(int $amount) : static
    {
        $this->amount += $amount;

        return $this;
    }

    public function removeProduct(int $amount) : static
    {
        $this->amount -= $amount;

        return $this;
    }

    /**
     * @return Collection<int, Change>
     */
    public function getChanges(): Collection
    {
        return $this->changes;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getNewAmount(): int
    {
        $amount = 0;
        $changes = $this->getChanges();
        foreach ($changes as $change) {
            if ($change->getType() == 'Output') {
                $amount -= $change->getAmount();
            }else {
                $amount += $change->getAmount();
            }
            
        }

        return $amount;
    }

}
