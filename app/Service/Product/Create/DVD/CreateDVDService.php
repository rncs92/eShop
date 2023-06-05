<?php declare(strict_types=1);

namespace EShop\Service\Product\Create\DVD;

use EShop\Models\Products\DVD;
use EShop\Repository\DVDRepository\DVDRepository;
use EShop\Service\Product\Create\Product\CreateProductRequest;

class CreateDVDService
{
    private DVDRepository $DVDRepository;

    public function __construct(DVDRepository $DVDRepository)
    {
        $this->DVDRepository = $DVDRepository;
    }

    public function handle(CreateProductRequest $request): CreateDVDResponse
    {
        $dvd = new DVD(
            $request->getSku(),
            $request->getName(),
            $request->getPrice(),
            $request->getProductType(),
            $request->getAttributes()
        );

        $this->DVDRepository->insert($dvd);

        return new CreateDVDResponse($dvd);
    }
}