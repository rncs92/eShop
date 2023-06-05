<?php declare(strict_types=1);

namespace EShop\Repository\DVDRepository;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use EShop\Core\Database;
use EShop\Models\Products\DVD;
use EShop\Models\Products\Product;

class PDODVDRepository implements DVDRepository
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
        $dvds = $queryBuilder
            ->select('*')
            ->from('products')
            ->where('product_type = ?')
            ->setParameter(0, 'DVD')
            ->fetchAllAssociative();

        $collection = [];
        foreach($dvds as $dvd) {
            $collection[] = $this->buildDVDModel($dvd);
        }

        return $collection;
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
}