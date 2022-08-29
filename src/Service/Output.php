<?php

declare(strict_types=1);

namespace HPT\Service;

use HPT\Model\Product;

interface Output
{
    public function getJson(iterable $products): string;
}
