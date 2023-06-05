<?php declare(strict_types=1);

namespace EShop\Service\Product\Create\Book;

use EShop\Models\Products\Book;
use EShop\Repository\BookRepository\BookRepository;
use EShop\Service\Product\Create\Product\CreateProductRequest;

class CreateBookService
{
    private BookRepository $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {

        $this->bookRepository = $bookRepository;
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

        $this->bookRepository->insert($book);

        return new CreateBookResponse($book);
    }
}