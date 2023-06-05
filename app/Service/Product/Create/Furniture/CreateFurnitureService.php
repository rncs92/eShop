<?php declare(strict_types=1);

namespace EShop\Service\Product\Create\Furniture;

use EShop\Models\Products\Furniture;
use EShop\Repository\Product\ProductRepository;
use EShop\Service\Product\Create\Product\CreateProductRequest;

class CreateFurnitureService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(CreateProductRequest $request): CreateFurnitureResponse
    {
        $furniture = new Furniture(
            $request->getSku(),
            $request->getName(),
            $request->getPrice(),
            $request->getProductType(),
            $request->getAttributes()
        );

        $this->productRepository->insert($furniture);

        return new CreateFurnitureResponse($furniture);
    }
}