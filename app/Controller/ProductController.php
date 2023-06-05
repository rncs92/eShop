<?php declare(strict_types=1);

namespace EShop\Controller;

use EShop\Core\Redirect;
use EShop\Core\TwigView;
use EShop\Service\Product\Create\Book\CreateBookService;
use EShop\Service\Product\Create\DVD\CreateDVDService;
use EShop\Service\Product\Create\Furniture\CreateFurnitureService;
use EShop\Service\Product\Create\Product\CreateProductRequest;

class ProductController
{
    private CreateBookService $createBookService;
    private CreateDVDService $createDVDService;
    private CreateFurnitureService $createFurnitureService;

    public function __construct(
        CreateBookService      $createBookService,
        CreateDVDService       $createDVDService,
        CreateFurnitureService $createFurnitureService
    )
    {
        $this->createBookService = $createBookService;
        $this->createDVDService = $createDVDService;
        $this->createFurnitureService = $createFurnitureService;
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
        if ($_POST['productType'] === 'DVD') {
            $this->createDVDService->handle(
                new CreateProductRequest(
                    $_POST['sku'],
                    $_POST['name'],
                    (int)$_POST['price'],
                    $_POST['productType'],
                    $_POST['size']
                )
            );
            return new Redirect('/');
        }

        if ($_POST['productType'] === 'Book') {
            $this->createBookService->handle(
                new CreateProductRequest(
                    $_POST['sku'],
                    $_POST['name'],
                    (int)$_POST['price'],
                    $_POST['productType'],
                    $_POST['weight']
                )
            );
            return new Redirect('/');
        }

        if ($_POST['productType'] === 'Furniture') {
            $this->createFurnitureService->handle(
                new CreateProductRequest(
                    $_POST['sku'],
                    $_POST['name'],
                    (int)$_POST['price'],
                    $_POST['productType'],
                    $_POST['height'] . 'x' . $_POST['width'] . 'x' . $_POST['length']
                )
            );
            return new Redirect('/');
        }

        return new Redirect('/add');
    }
}