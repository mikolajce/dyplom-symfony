<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $sum_total = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client_id = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Status $status_id = null;

    #[ORM\ManyToMany(targetEntity: Product::class, inversedBy: 'order_id')]
    private Collection $cart_id;

    public function __construct()
    {
        $this->cart_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSumTotal(): ?float
    {
        return $this->sum_total;
    }

    public function setSumTotal(float $sum_total): static
    {
        $this->sum_total = $sum_total;

        return $this;
    }

    public function getClientId(): ?Client
    {
        return $this->client_id;
    }

    public function setClientId(?Client $client_id): static
    {
        $this->client_id = $client_id;

        return $this;
    }

    public function getStatusId(): ?Status
    {
        return $this->status_id;
    }

    public function setStatusId(?Status $status_id): static
    {
        $this->status_id = $status_id;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getCartId(): Collection
    {
        return $this->cart_id;
    }

    public function addCartId(Product $cartId): static
    {
        if (!$this->cart_id->contains($cartId)) {
            $this->cart_id->add($cartId);
        }

        return $this;
    }

    public function removeCartId(Product $cartId): static
    {
        $this->cart_id->removeElement($cartId);

        return $this;
    }
}
