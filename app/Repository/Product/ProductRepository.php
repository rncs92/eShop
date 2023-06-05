<?php

namespace EShop\Repository\Product;

use EShop\Models\Products\Product;

interface ProductRepository
{
    public function all(): array;

    public function insert(Product $product): void;
}