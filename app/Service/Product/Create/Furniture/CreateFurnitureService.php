<?php declare(strict_types=1);

namespace EShop\Service\Product\Create\Furniture;

use EShop\Models\Products\Furniture;
use EShop\Repository\FurnitureRepository\FurnitureRepository;
use EShop\Service\Product\Create\Product\CreateProductRequest;

class CreateFurnitureService
{
    private FurnitureRepository $furnitureRepository;

    public function __construct(FurnitureRepository $furnitureRepository)
    {
        $this->furnitureRepository = $furnitureRepository;
    }

    public function handle(CreateProductRequest $request): CreateFurnitureResponse
    {
        $furniture = new Furniture(
            $request->getSku(),
            $request->getName(),
            $request->getPrice(),
            $request->getProductType(),
            $request->getAttributes()
        );

        $this->furnitureRepository->insert($furniture);

        return new CreateFurnitureResponse($furniture);
    }
}