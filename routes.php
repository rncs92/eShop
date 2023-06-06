<?php

use EShop\Controller\ProductController;

return[
    //Show
    ['GET', '/', [ProductController::class, 'index']],
    //Create Product
    ['GET', '/add', [ProductController::class, 'add']],
    ['POST', '/add', [ProductController::class, 'store']],
    //Delete Product
    ['POST', '/', [ProductController::class, 'delete']],
];
