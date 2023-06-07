<?php declare(strict_types=1);

namespace EShop\Service\Product\Delete;

use EShop\Repository\ProductRepository\ProductRepository;

class DeleteProductService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(int $productId): void
    {
        $this->productRepository->delete($productId);
    }
}