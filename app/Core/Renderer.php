<?php declare(strict_types=1);

namespace EShop\Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Renderer
{
    private Environment $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader('../app/Views/');
        $this->twig = new Environment($loader);
        $this->twig->addGlobal('session', $_SESSION);
        if (isset($_SESSION['errors'])) {
            $this->twig->addGlobal('errors', $_SESSION['errors']);
        } else {
            $this->twig->addGlobal('errors', array());
        }
    }

    public function render(TwigView $view): string
    {
        return $this->twig->render($view->getTemplatePath().'.html.twig', $view->getParameters());
    }
}