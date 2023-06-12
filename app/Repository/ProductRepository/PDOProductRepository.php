<?php declare(strict_types=1);

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

    public function delete(int $productId): void
    {
        $queryBuilder = $this->queryBuilder;
        $queryBuilder
            ->delete('products')
            ->where('id = ?')
            ->setParameter(0, $productId);

        $queryBuilder->executeQuery();
    }

    public function getBySku(string $sku): ?Product
    {
        $queryBuilder = $this->queryBuilder;
        $sku = $queryBuilder->select('*')
            ->from('products')
            ->where('sku = ?')
            ->setParameter(0, $sku)
            ->fetchAssociative();

        if (!$sku) {
            return null;
        }

        return $this->buildModel($sku);
    }


    private function buildModel($product): ?Product
    {
        if($product['product_type'] === 'DVD') {
            return new DVD(
                $product['sku'],
                $product['name'],
                (float)$product['price'],
                $product['product_type'],
                $product['attribute'],
                (int)$product['id']
            );
        }

        if($product['product_type'] === 'Book') {
            return new Book(
                $product['sku'],
                $product['name'],
                (float)$product['price'],
                $product['product_type'],
                $product['attribute'],
                (int)$product['id']
            );
        }

        if($product['product_type'] === 'Furniture') {
            return new Furniture(
                $product['sku'],
                $product['name'],
                (float)$product['price'],
                $product['product_type'],
                $product['attribute'],
                (int)$product['id']
            );
        }
        return null;
    }
}