<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $surname = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Ordering::class)]
    private Collection $orderings;

    public function __construct()
    {
        $this->orderings = new ArrayCollection();
    }

    public function __toString(): string
    {
        return (string) $this->getId();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): static
    {
        $this->surname = $surname;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection<int, Ordering>
     */
    public function getOrderings(): Collection
    {
        return $this->orderings;
    }

    public function addOrdering(Ordering $ordering): static
    {
        if (!$this->orderings->contains($ordering)) {
            $this->orderings->add($ordering);
            $ordering->setClient($this);
        }

        return $this;
    }

    public function removeOrdering(Ordering $ordering): static
    {
        if ($this->orderings->removeElement($ordering)) {
            // set the owning side to null (unless already changed)
            if ($ordering->getClient() === $this) {
                $ordering->setClient(null);
            }
        }

        return $this;
    }
}
