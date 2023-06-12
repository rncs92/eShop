<?php declare(strict_types=1);

namespace EShop\Controller;

use Dotenv\Exception\ValidationException;
use EShop\Core\Redirect;
use EShop\Core\TwigView;
use EShop\Repository\ProductRepository\PDOProductRepository;
use EShop\Service\Product\Create\Book\CreateBookService;
use EShop\Service\Product\Create\DVD\CreateDVDService;
use EShop\Service\Product\Create\Furniture\CreateFurnitureService;
use EShop\Service\Product\Create\Product\CreateProductRequest;
use EShop\Service\Product\Delete\DeleteProductService;
use EShop\Validation\AddFormValidator;

class ProductController
{
    private CreateBookService $createBookService;
    private CreateDVDService $createDVDService;
    private CreateFurnitureService $createFurnitureService;
    private PDOProductRepository $PDOProductRepository;
    private DeleteProductService $deleteProductService;
    private AddFormValidator $validator;

    public function __construct(
        CreateBookService      $createBookService,
        CreateDVDService       $createDVDService,
        CreateFurnitureService $createFurnitureService,
        PDOProductRepository   $PDOProductRepository,
        DeleteProductService   $deleteProductService,
        AddFormValidator $validator
    )
    {
        $this->createBookService = $createBookService;
        $this->createDVDService = $createDVDService;
        $this->createFurnitureService = $createFurnitureService;
        $this->PDOProductRepository = $PDOProductRepository;
        $this->deleteProductService = $deleteProductService;
        $this->validator = $validator;
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
        //var_dump($_SESSION['errors']);
        return new TwigView('Product/addProduct', []);
    }

    public function store(): Redirect
    {
        try {
            $this->validator->validateSKU($_POST);

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
            }
            return new Redirect('/');
        } catch (ValidationException $exception) {
            //var_dump($this->validator->getErrors());
            return new Redirect('/addproduct');
        }
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