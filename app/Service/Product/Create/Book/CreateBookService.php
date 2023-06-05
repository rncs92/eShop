<?php declare(strict_types=1);

namespace EShop\Service\Product\Create\Book;

use EShop\Models\Products\Book;
use EShop\Repository\Product\ProductRepository;
use EShop\Service\Product\Create\Product\CreateProductRequest;

class CreateBookService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {

        $this->productRepository = $productRepository;
    }

    public function handle(CreateProductRequest $request): CreateBookResponse
    {
        $book = new Book(
            $request->getSku(),
            $request->getName(),
            $request->getPrice(),
            $request->getProductType(),
            $request->getAttributes()
        );

        $this->productRepository->insert($book);

        return new CreateBookResponse($book);
    }
}