<?php declare(strict_types=1);

namespace EShop\Service\Product\Create\Product;

class CreateProductRequest
{
    private string $sku;
    private string $name;
    private int $price;
    private string $productType;
    private string $attributes;


    public function __construct(
        string $sku,
        string $name,
        int    $price,
        string $productType,
        string $attributes
    )
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->productType = $productType;
        $this->attributes = $attributes;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getProductType(): string
    {
        return $this->productType;
    }

    public function getAttributes(): string
    {
        return $this->attributes;
    }
}