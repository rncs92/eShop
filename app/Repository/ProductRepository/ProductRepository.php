<?php declare(strict_types=1);

namespace EShop\Repository\ProductRepository;

use EShop\Models\Products\Product;

interface ProductRepository
{
    public function all(): array;

    public function insert(Product $product): void;

    public function delete(int $productId): void;

    public function getBySku(string $sku): ?Product;
}