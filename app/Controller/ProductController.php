<?php declare(strict_types=1);

namespace EShop\Controller;

use EShop\Core\TwigView;

class ProductController
{
    public function index(): TwigView
    {
        return new TwigView('Index/index', [

        ]);
    }
}