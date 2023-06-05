<?php

use EShop\Repository\BookRepository\BookRepository;
use EShop\Repository\BookRepository\PDOBookRepository;
use EShop\Repository\DVDRepository\DVDRepository;
use EShop\Repository\DVDRepository\PDODVDRepository;
use EShop\Repository\FurnitureRepository\FurnitureRepository;
use EShop\Repository\FurnitureRepository\PDOFurnitureRepository;


return [
    'classes' => [
        BookRepository::class => new PDOBookRepository(),
        DVDRepository::class => new PDODVDRepository(),
        FurnitureRepository::class => new PDOFurnitureRepository(),
    ],
];