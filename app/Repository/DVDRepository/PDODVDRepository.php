<?php declare(strict_types=1);

namespace EShop\Repository\DVDRepository;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use EShop\Core\Database;
use EShop\Models\Products\DVD;
use EShop\Models\Products\Product;
use EShop\Repository\Product\ProductRepository;

class PDODVDRepository implements ProductRepository
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
            $collection[] = $this->buildDVDModel($product);
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
            $dvd['attribute']
        );
    }
}