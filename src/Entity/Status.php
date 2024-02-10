<?php

namespace App\Entity;

use App\Repository\StatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatusRepository::class)]
class Status
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $code = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'status', targetEntity: Ordering::class)]
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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

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
            $ordering->setStatus($this);
        }

        return $this;
    }

    public function removeOrdering(Ordering $ordering): static
    {
        if ($this->orderings->removeElement($ordering)) {
            // set the owning side to null (unless already changed)
            if ($ordering->getStatus() === $this) {
                $ordering->setStatus(null);
            }
        }

        return $this;
    }
}
