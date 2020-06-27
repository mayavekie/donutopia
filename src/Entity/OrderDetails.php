<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\OrderDetailsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={"get"={"order-details"}, "post"={"order-details"}},
 *     itemOperations={"get"={"path"="/order-details/{id}"}, "put"={"path"="/order-details/{id}"}},
 *     normalizationContext={"groups"={"orderDet:read"}},
 *     denormalizationContext={"groups"={"orderDet:write"}}
 * )
 * @ORM\Entity(repositoryClass=OrderDetailsRepository::class)
 */
class OrderDetails
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"order:read", "order:write"})
     */
    private $quantity;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"order:read", "order:write"})
     */
    private $priceProduct;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"order:read"})
     */
    private $tax=21;

    /**
     * @ORM\ManyToOne(targetEntity=Orders::class, inversedBy="orderDetails")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"orderDet:read"})
     */
    private $bestelling;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="orderDetails")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"orderDet:read", "order:read"})
     */
    private $product;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPriceProduct(): ?int
    {
        return $this->priceProduct;
    }

    public function setPriceProduct(int $priceProduct): self
    {
        $this->priceProduct = $priceProduct;

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

    public function getBestelling(): ?Orders
    {
        return $this->bestelling;
    }

    public function setBestelling(?Orders $bestelling): self
    {
        $this->bestelling = $bestelling;

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

//    public function __toString()
//    {
//        // TODO: Implement __toString() method.
//        return (string) $this->getProduct(). " #". $this->getQuantity();
//    }
}
