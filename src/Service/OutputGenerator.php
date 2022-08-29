<?php

declare(strict_types=1);

namespace HPT\Service;

use HPT\Enum\ProductProperty;
use HPT\Model\Product;

class OutputGenerator implements Output
{
    /**
     * @param array<Product> $products
     */
    public function getJson(array $products): string
    {
        $output = [];
        foreach($products as $product){
            // TODO more attributes to add here
            $productInfo = [ProductProperty::PRICE => $product->getPrice()];
            $output[$product->getId()] = $productInfo;
        }

        return json_encode($output);
    }
}
