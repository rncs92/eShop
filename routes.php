<?php

use EShop\Controller\ProductController;

return[
    //Show
    ['GET', '/', [ProductController::class, 'index']],
    //Create Product
    ['GET', '/addproduct', [ProductController::class, 'add']],
    ['POST', '/addproduct', [ProductController::class, 'store']],
    //Delete Product
    ['POST', '/', [ProductController::class, 'delete']],
];
