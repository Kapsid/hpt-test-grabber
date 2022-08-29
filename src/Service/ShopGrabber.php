<?php

declare(strict_types=1);

namespace HPT\Service;

use HPT\Enum\ProductProperty;
use HPT\Factory\ProductFactory;
use HPT\Model\Product;
use PHPHtmlParser\Dom;

class ShopGrabber implements Grabber
{
    private const SEARCH_URL = 'https://www.czc.cz/%s/hledat';

    private ProductFactory $productFactory;

    private Dom $dom;

    public function __construct(
        ProductFactory $productFactory,
        Dom $dom
    ) {
        $this->productFactory = $productFactory;
        $this->dom = $dom;
    }

    private function getProduct(string $productId): Product
    {
        $urlToCheck = sprintf(self::SEARCH_URL, $productId);
        $parsedHtml = $this->getProductInfoFromHtml($productId, $urlToCheck);
        return $this->productFactory->create($parsedHtml);
    }

    /**
     * @return array<string, float>
     */
    private function getProductInfoFromHtml(string $productId, string $url): array
    {
        $productInfo = [
            ProductProperty::ID => $productId,
            ProductProperty::PRICE => null
        ];

        $this->dom->loadFromUrl($url);
        $price = $this->dom->find('.price > .price-vatin')[0];

        if($price !== null){
            $productInfo[ProductProperty::PRICE] = (float)filter_var($price->innerHtml, FILTER_SANITIZE_NUMBER_FLOAT);
        }

        return $productInfo;
    }

    /**
     * @param array<string> $productIds
     *
     * @return array<Product>
     */
    public function getProducts(array $productIds): array
    {
        $products = [];
        foreach($productIds as $productId){
            $products[] = $this->getProduct($productId);
        }
        return $products;
    }
}
