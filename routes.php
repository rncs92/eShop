<?php

use EShop\Controller\ProductController;

return[
    //Show
    ['GET', '/', [ProductController::class, 'index']],
    //Create Product
    ['GET', '/add', [ProductController::class, 'add']],
    ['POST', '/', [ProductController::class, 'store']],
];
