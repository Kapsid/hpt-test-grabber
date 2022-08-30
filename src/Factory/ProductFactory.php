<?php

declare(strict_types=1);

namespace HPT\Factory;

use HPT\Enum\ProductProperty;
use HPT\Model\Product;

class ProductFactory
{
    /**
     * @param array{id: string, price: float|null, label: string|null, rating: int|null} $inputInfo
     */
    public function create(array $inputInfo): Product
    {
        $product = new Product();
        $product->setId($inputInfo[ProductProperty::ID]);
        $product->setPrice($inputInfo[ProductProperty::PRICE]);
        $product->setRating($inputInfo[ProductProperty::RATING]);
        $product->setLabel($inputInfo[ProductProperty::LABEL]);

        return $product;
    }
}
