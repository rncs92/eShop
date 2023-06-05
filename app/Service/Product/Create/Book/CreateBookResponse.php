<?php declare(strict_types=1);

namespace EShop\Service\Product\Create\Book;

use EShop\Models\Products\Book;


class CreateBookResponse
{
    private Book $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    public function getBook(): Book
    {
        return $this->book;
    }
}