<?php declare(strict_types=1);

namespace EShop\Service\Product\Create\DVD;

use EShop\Models\Products\DVD;
use EShop\Repository\Product\ProductRepository;
use EShop\Service\Product\Create\Product\CreateProductRequest;

class CreateDVDService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(CreateProductRequest $request): CreateDVDResponse
    {
        $dvd = new DVD(
            $request->getSku(),
            $request->getName(),
            $request->getPrice(),
            $request->getProductType(),
            $request->getAttributes()
        );

        $this->productRepository->insert($dvd);

        return new CreateDVDResponse($dvd);
    }
}