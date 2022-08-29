<?php

declare(strict_types=1);

namespace HPT\Service;

use HPT\Model\Product;

interface Output
{
    /**
     * @param array<Product> $products
     */
    public function getJson(array $products): string;
}
