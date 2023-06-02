<?php declare(strict_types=1);

namespace EShop\Core;

class Redirect implements Response
{
    private string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function getPath(): string
    {
        return $this->path;
    }

}