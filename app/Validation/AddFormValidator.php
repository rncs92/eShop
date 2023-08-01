<?php declare(strict_types=1);

namespace EShop\Validation;

use Dotenv\Exception\ValidationException;
use EShop\Repository\ProductRepository\ProductRepository;

class AddFormValidator
{
    private ProductRepository $productRepository;
    private array $errors = [];

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function validateSKU(array $fields = []): void
    {
        $sku = $this->productRepository->getBySku($fields['sku']);

        if($sku !== null) {
            $this->errors['sku'][] = 'Product with this SKU exists!';
        }

        if(count($this->errors) > 0) {
            $_SESSION['errors'] = $this->errors;

            throw new ValidationException('Form validation has failed');
        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}