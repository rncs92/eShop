<?php

namespace EShop\Models\Products;

class Product
{
    private string $sku;
    private string $name;
    private int $price;
    private string $attribute;
    private ?int $id;

    public function __construct(
        string $sku,
        string $name,
        int $price,
        string $attribute,
        int $id = null
    )
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->attribute = $attribute;
        $this->id = $id;
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

    public function getAttribute(): string
    {
        return $this->attribute;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

}