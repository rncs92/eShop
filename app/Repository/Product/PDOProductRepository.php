<?php

namespace EShop\Repository\Product;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use EShop\Core\Database;
use EShop\Models\Products\Book;
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
        $queryBuilder = $this->queryBuilder;
        $products = $queryBuilder->select('*')
            ->from('products')
            ->fetchAllAssociative();

        $collection = [];
        foreach($products as $product) {
            $collection[] = $this->buildModel($product);
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
                    'attributes' => '?'
                ]
            )
            ->setParameter(0, $product->getSku())
            ->setParameter(1, $product->getName())
            ->setParameter(2, $product->getPrice())
            ->setParameter(3, $product->getAttribute());

        $queryBuilder->executeQuery();

        $product->setId((int)$this->connection->lastInsertId());
    }

    private function buildModel($product): Product
    {
        return new Product(
            $product['sku'],
            $product['name'],
            $product['price'],
            $product['attributes']
        );
    }
}