<?php

declare(strict_types=1);

namespace HPT\Service;

use HPT\Model\Product;

interface Grabber
{
    /**
     * @param array<string> $productIds
     *
     * @return array<Product>
     */
    public function getProducts(array $productIds): array;
}
