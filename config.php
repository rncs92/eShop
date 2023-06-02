<?php

use EShop\Repository\Product\PDOProductRepository;
use EShop\Repository\Product\ProductRepository;

return [
    'classes' => [
        ProductRepository::class => new PDOProductRepository(),
    ],
];