<?php declare(strict_types=1);

namespace EShop\Repository\BookRepository;

use EShop\Models\Products\Product;

interface BookRepository
{
    public function all(): array;

    public function insert(Product $product): void;
}