<?php declare(strict_types=1);

namespace EShop\Core;

class TwigView implements Response
{
    private string $template;
    private array $response;

    public function __construct(string $template, array $response)
    {
        $this->template = $template;
        $this->response = $response;
    }

    public function getTemplatePath(): string
    {
        return $this->template;
    }

    public function getParameters(): array
    {
        return $this->response;
    }
}