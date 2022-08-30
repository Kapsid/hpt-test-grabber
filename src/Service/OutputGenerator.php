<?php

declare(strict_types=1);

namespace HPT\Service;

use HPT\Enum\ProductProperty;
use HPT\Model\Product;

class OutputGenerator implements Output
{
    /**
     * @param iterable<mixed> $products
     */
    public function getJson(iterable $products): string
    {
        $output = [];
        foreach ($products as $product) {
            $productInfo = [
                ProductProperty::PRICE => $product->getPrice(),
                ProductProperty::LABEL => $product->getLabel(),
                ProductProperty::RATING => $product->getRating(),
                ];

            $output[$product->getId()] = $productInfo;
        }

        return json_encode($output);
    }
}
