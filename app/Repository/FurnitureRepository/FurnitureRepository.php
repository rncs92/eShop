<?php declare(strict_types=1);

namespace EShop\Repository\FurnitureRepository;

use EShop\Models\Products\Product;

interface FurnitureRepository
{
    public function all(): array;

    public function insert(Product $product): void;
}