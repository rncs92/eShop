<?php

namespace EShop\Models\Products;

abstract class Product
{
    protected string $sku;
    protected string $name;
    protected int $price;
    protected string $productType;
    private string $attribute;
    private ?int $id;


    public function __construct(
        string $sku,
        string $name,
        int    $price,
        string $productType,
        string $attribute,
        int    $id = null
    )
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->productType = $productType;
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

    public function getProductType(): string
    {
        return $this->productType;
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