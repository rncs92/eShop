<?php declare(strict_types=1);

namespace EShop\Service\Product\Create\Furniture;

use EShop\Models\Products\Furniture;

class CreateFurnitureResponse
{
    private Furniture $furniture;

    public function __construct(Furniture $furniture)
    {
        $this->furniture = $furniture;
    }

    public function getFurniture(): Furniture
    {
        return $this->furniture;
    }
}