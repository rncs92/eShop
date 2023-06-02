<?php

namespace EShop\Service\Product\Create;

use EShop\Models\Products\Product;

class CreateProductResponse
{
    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }
}