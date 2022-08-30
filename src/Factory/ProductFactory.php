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
        $product->setId($inputInfo[ProductProperty::ID] ?? null);
        $product->setPrice($inputInfo[ProductProperty::PRICE] ?? null);
        $product->setRating($inputInfo[ProductProperty::RATING] ?? null);
        $product->setLabel($inputInfo[ProductProperty::LABEL] ?? null);

        return $product;
    }
}
