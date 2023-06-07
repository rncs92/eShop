<?php declare(strict_types=1);

namespace EShop\Repository\BookRepository;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use EShop\Core\Database;
use EShop\Models\Products\Book;
use EShop\Models\Products\Product;

class PDOBookRepository implements BookRepository
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
            $collection[] = $this->buildBookModel($product);
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

    private function buildBookModel($book): Product
    {
        return new Book(
            $book['sku'],
            $book['name'],
            (float)$book['price'],
            $book['product_type'],
            $book['attribute']
        );
    }
}
