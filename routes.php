<?php

use EShop\Controller\ProductController;

return[
    ['GET', '/', [ProductController::class, 'index']],
];
