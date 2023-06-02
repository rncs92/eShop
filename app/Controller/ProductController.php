<?php declare(strict_types=1);

namespace EShop\Controller;

use Doctrine\DBAL\Exception;
use EShop\Core\Redirect;
use EShop\Core\TwigView;
use EShop\Service\Product\Create\CreateProductRequest;
use EShop\Service\Product\Create\CreateProductService;

class ProductController
{
    private CreateProductService $createProductService;

    public function __construct(CreateProductService $createProductService)
        {
            $this->createProductService = $createProductService;
        }

    public function index(): TwigView
    {
        return new TwigView('Index/index', [

        ]);
    }

    public function add(): TwigView
    {
        return new TwigView('Product/addProduct', []);
    }

    public function store(): Redirect
    {
        try {
            $this->createProductService->handle(
                new CreateProductRequest(
                    $_POST['sku'],
                    $_POST['name'],
                    $_POST['price'],
                    $_POST['attributes']
                )
            );

            return new Redirect('/');
        } catch(Exception $exception)
        {
            return new Redirect('/add');
        }
    }
}