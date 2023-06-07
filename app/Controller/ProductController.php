<?php declare(strict_types=1);

namespace EShop\Controller;

use EShop\Core\Redirect;
use EShop\Core\TwigView;
use EShop\Repository\ProductRepository\PDOProductRepository;
use EShop\Service\Product\Create\Book\CreateBookService;
use EShop\Service\Product\Create\DVD\CreateDVDService;
use EShop\Service\Product\Create\Furniture\CreateFurnitureService;
use EShop\Service\Product\Create\Product\CreateProductRequest;
use EShop\Service\Product\Delete\DeleteProductService;

class ProductController
{
    private CreateBookService $createBookService;
    private CreateDVDService $createDVDService;
    private CreateFurnitureService $createFurnitureService;
    private PDOProductRepository $PDOProductRepository;
    private DeleteProductService $deleteProductService;

    public function __construct(
        CreateBookService      $createBookService,
        CreateDVDService       $createDVDService,
        CreateFurnitureService $createFurnitureService,
        PDOProductRepository   $PDOProductRepository,
        DeleteProductService   $deleteProductService
    )
    {
        $this->createBookService = $createBookService;
        $this->createDVDService = $createDVDService;
        $this->createFurnitureService = $createFurnitureService;
        $this->PDOProductRepository = $PDOProductRepository;
        $this->deleteProductService = $deleteProductService;
    }

    public function index(): TwigView
    {
        $products = $this->PDOProductRepository->all();

        return new TwigView('Index/index', [
            'products' => $products

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
                    (float)$_POST['price'],
                    $_POST['productType'],
                    $_POST['size'] . ' MB'
                )
            );
            return new Redirect('/');
        }

        if ($_POST['productType'] === 'Book') {
            $this->createBookService->handle(
                new CreateProductRequest(
                    $_POST['sku'],
                    $_POST['name'],
                    (float)$_POST['price'],
                    $_POST['productType'],
                    $_POST['weight'] . ' kg'
                )
            );
            return new Redirect('/');
        }

        if ($_POST['productType'] === 'Furniture') {
            $this->createFurnitureService->handle(
                new CreateProductRequest(
                    $_POST['sku'],
                    $_POST['name'],
                    (float)$_POST['price'],
                    $_POST['productType'],
                    $_POST['height'] . 'x' . $_POST['width'] . 'x' . $_POST['length']
                )
            );
            return new Redirect('/');
        }

        return new Redirect('/add');
    }

    public function delete(): Redirect
    {
        if (isset($_POST['delete-product-btn'])) {
            foreach ((array)$_POST['checkbox'] as $productId) {
                $this->deleteProductService->handle((int)$productId);
            }
        }

        return new Redirect('/');
    }
}