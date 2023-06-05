<?php

namespace EShop\Repository\ProductRepository;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use EShop\Core\Database;
use EShop\Models\Products\Book;
use EShop\Models\Products\DVD;
use EShop\Models\Products\Furniture;
use EShop\Models\Products\Product;

class PDOProductRepository implements ProductRepository
{
    private QueryBuilder $queryBuilder;
    private Connection $connection;

    public function __construct()
    {
        $this->connection = Database::getConnection();
        $this->queryBuilder = $this->connection->createQueryBuilder();
    }

    public function all(): array
    {
        $collection = [];
        $queryBuilder = $this->queryBuilder;
        $dvds = $queryBuilder
            ->select('*')
            ->from('products')
            ->where('product_type = ?')
            ->setParameter(0, 'DVD')
            ->fetchAllAssociative();

        foreach($dvds as $dvd) {
            $collection[] = $this->buildDVDModel($dvd);
        }

        $books = $queryBuilder
            ->select('*')
            ->from('products')
            ->where('product_type = ?')
            ->setParameter(0, 'Book')
            ->fetchAllAssociative();

        foreach($books as $book) {
            $collection[] = $this->buildBookModel($book);
        }

        $furnitures = $queryBuilder
            ->select('*')
            ->from('products')
            ->where('product_type = ?')
            ->setParameter(0, 'Furniture')
            ->fetchAllAssociative();

        foreach($furnitures as $furniture) {
            $collection[] = $this->buildFurnitureModel($furniture);
        }

        return $collection;
    }

    public function insert(Product $product): void
    {
        $queryBuilder = $this->queryBuilder;
        $queryBuilder
            ->insert('products')
            ->values(
                [
                    'sku' => '?',
                    'name' => '?',
                    'price' => '?',
                    'product_type' => '?',
                    'attribute' => '?'
                ]
            )
            ->setParameter(0, $product->getSku())
            ->setParameter(1, $product->getName())
            ->setParameter(2, $product->getPrice())
            ->setParameter(3, $product->getProductType())
            ->setParameter(4, $product->getAttribute());

        $queryBuilder->executeQuery();

        $product->setId((int)$this->connection->lastInsertId());
    }

    private function buildDVDModel($dvd): Product
    {
        return new DVD(
            $dvd['sku'],
            $dvd['name'],
            (int)$dvd['price'],
            $dvd['product_type'],
            $dvd['attribute'],
            $dvd['id']
        );
    }

    private function buildFurnitureModel($furniture): Product
    {
        return new Furniture(
            $furniture['sku'],
            $furniture['name'],
            (int)$furniture['price'],
            $furniture['product_type'],
            $furniture['attribute'],
            $furniture['id']
        );
    }

    private function buildBookModel($book): Product
    {
        return new Book(
            $book['sku'],
            $book['name'],
            (int)$book['price'],
            $book['product_type'],
            $book['attribute'],
            $book['id']
        );
    }
}