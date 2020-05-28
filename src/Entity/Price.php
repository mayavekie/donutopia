<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PriceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={"get", "post"={"price"}},
 *     itemOperations={
 *          "get"={"path"="/price/{id}"},
 *          "put"={"path"="/price/{id}"},
 *          "delete"={"path"="/price/{id}"}},
 *     normalizationContext={"groups"={"price:read"}},
 *     denormalizationContext={"groups"={"price:write"}}
 * )
 * @ORM\Entity(repositoryClass=PriceRepository::class)
 */
class Price
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"price:read", "price:write"})
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"price:read", "price:write"})
     */
    private $tax;

    /**
     * @ORM\Column(type="date")
     * @Groups({"price:read", "price:write"})
     */
    private $startDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"price:read", "price:write"})
     */
    private $endDate;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="price")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"price:read"})
     */
    private $product;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getTax(): ?int
    {
        return $this->tax;
    }

    public function setTax(int $tax): self
    {
        $this->tax = $tax;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }
}
