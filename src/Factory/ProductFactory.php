<?php

declare(strict_types=1);

namespace HPT\Factory;

use HPT\Enum\ProductProperty;
use HPT\Model\Product;

class ProductFactory
{
    /**
     * @param array<float, string> $inputInfo
     */
    public function create(array $inputInfo): Product
    {
        $product = new Product();
        $product->setId($inputInfo[ProductProperty::ID]);
        $product->setPrice($inputInfo[ProductProperty::PRICE]);
        return $product;
    }
}
