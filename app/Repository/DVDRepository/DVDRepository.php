<?php declare(strict_types=1);

namespace EShop\Repository\DVDRepository;

use EShop\Models\Products\Product;

interface DVDRepository
{
    public function all(): array;

    public function insert(Product $product): void;
}