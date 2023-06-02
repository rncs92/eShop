<?php

namespace EShop\Service\Product\Create;

class CreateProductRequest
{
    private string $sku;
    private string $name;
    private int $price;
    private string $attributes;

    public function __construct(
        string $sku,
        string $name,
        int    $price,
        string $attributes
    )
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
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

    public function getAttributes(): string
    {
        return $this->attributes;
    }
}