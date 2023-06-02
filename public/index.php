<?php

use EShop\Core\Redirect;
use EShop\Core\Renderer;
use EShop\Core\Router;
use EShop\Core\Session;
use EShop\Core\TwigView;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();

$loader = new FilesystemLoader('../app/Views');
$twig = new Environment($loader);

$routes = require_once '../routes.php';
$response = Router::route($routes);


if($response instanceof TwigView) {
    $renderer = new Renderer();

    echo $renderer->render($response);
    Session::unflash();
}

if($response instanceof Redirect) {
    header('Location: '.$response->getPath());
}