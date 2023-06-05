<?php declare(strict_types=1);

namespace EShop\Controller;

use EShop\Core\Redirect;
use EShop\Core\TwigView;
use EShop\Repository\BookRepository\PDOBookRepository;
use EShop\Repository\DVDRepository\PDODVDRepository;
use EShop\Repository\FurnitureRepository\PDOFurnitureRepository;
use EShop\Repository\ProductRepository\PDOProductRepository;
use EShop\Service\Product\Create\Book\CreateBookService;
use EShop\Service\Product\Create\DVD\CreateDVDService;
use EShop\Service\Product\Create\Furniture\CreateFurnitureService;
use EShop\Service\Product\Create\Product\CreateProductRequest;

class ProductController
{
    private CreateBookService $createBookService;
    private CreateDVDService $createDVDService;
    private CreateFurnitureService $createFurnitureService;
    private PDODVDRepository $PDODVDRepository;
    private PDOBookRepository $PDOBookRepository;
    private PDOFurnitureRepository $PDOFurnitureRepository;
    private PDOProductRepository $PDOProductRepository;

    public function __construct(
        CreateBookService      $createBookService,
        CreateDVDService       $createDVDService,
        CreateFurnitureService $createFurnitureService,
        PDODVDRepository $PDODVDRepository,
        PDOBookRepository $PDOBookRepository,
        PDOFurnitureRepository $PDOFurnitureRepository,
        PDOProductRepository $PDOProductRepository
    )
    {
        $this->createBookService = $createBookService;
        $this->createDVDService = $createDVDService;
        $this->createFurnitureService = $createFurnitureService;
        $this->PDODVDRepository = $PDODVDRepository;
        $this->PDOBookRepository = $PDOBookRepository;
        $this->PDOFurnitureRepository = $PDOFurnitureRepository;
        $this->PDOProductRepository = $PDOProductRepository;
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
                    (int)$_POST['price'],
                    $_POST['productType'],
                    'Size: ' . $_POST['size'] . ' MB'
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
                    'Weight: ' . $_POST['weight'] . ' kg'
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
                    'Dimension: ' . $_POST['height'] . 'x' . $_POST['width'] . 'x' . $_POST['length']
                )
            );
            return new Redirect('/');
        }

        return new Redirect('/add');
    }
}