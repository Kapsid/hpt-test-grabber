<?php

declare(strict_types=1);

namespace HPT\Service;

use HPT\Model\Product;
use Iterator;

interface Grabber
{
    /**
     * @param array<string> $productIds
     */
    public function getProducts(array $productIds): Iterator;
}
