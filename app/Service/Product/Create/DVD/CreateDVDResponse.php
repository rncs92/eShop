<?php declare(strict_types=1);

namespace EShop\Service\Product\Create\DVD;

use EShop\Models\Products\DVD;

class CreateDVDResponse
{
    private DVD $dvd;

    public function __construct(DVD $dvd)
    {
        $this->dvd = $dvd;
    }

    public function getDvd(): DVD
    {
        return $this->dvd;
    }
}