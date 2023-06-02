<?php

namespace EShop\Service\Product\Create;

use EShop\Models\Products\Product;
use EShop\Repository\Product\ProductRepository;

class CreateProductService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
   {
       $this->productRepository = $productRepository;
   }

   public function handle(CreateProductRequest $request): CreateProductResponse
   {
        $product = new Product(
            $request->getSku(),
            $request->getName(),
            $request->getPrice(),
            $request->getAttributes()
        );

        $this->productRepository->insert($product);

        return new CreateProductResponse($product);
   }
}