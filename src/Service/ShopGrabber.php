<?php

declare(strict_types=1);

namespace HPT\Service;

use HPT\Enum\ProductProperty;
use HPT\Factory\ProductFactory;
use HPT\Model\Product;
use PHPHtmlParser\Dom;
use Iterator;

class ShopGrabber implements Grabber
{
    private const SEARCH_URL = 'https://www.czc.cz/%s/hledat';

    private ProductDetailGrabber $productDetailGrabber;

    private ProductFactory $productFactory;

    private Dom $dom;

    public function __construct(
        ProductDetailGrabber $productDetailGrabber,
        ProductFactory $productFactory,
        Dom $dom
    ) {
        $this->productDetailGrabber = $productDetailGrabber;
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
     * @return array{id: string, price: float|null, label: string|null, rating:string|null} $inputInfo
     */
    private function getProductInfoFromHtml(string $productId, string $url): array
    {
        $productInfo = [
            ProductProperty::ID     => $productId,
            ProductProperty::PRICE  => null,
            ProductProperty::LABEL  => null,
            ProductProperty::RATING => null,
        ];

        $this->dom->loadFromUrl($url);
        $priceDom = $this->dom->find('.price > .price-vatin');
        $titleDom = $this->dom->find('.tile-title a');

        // TODO - possible improvement - logging if product is not found or is found in 'not for sale' - e.g. https://www.czc.cz/<PRODUCT CODE>/hledat/neprodavane
        if (count($priceDom) > 0) {
            $price = $priceDom[0];
            $productInfo[ProductProperty::PRICE] = (float)filter_var($price->innerHtml, FILTER_SANITIZE_NUMBER_FLOAT);
        }

        if ($titleDom->count() > 0) {
            /** @var  Dom\Node\AbstractNode $label */
            $label = $titleDom[0];
            $link = $label->tag->getAttribute("href")->getValue();

            $productInfo[ProductProperty::LABEL] = $this->productDetailGrabber->getLabel($link);
            $productInfo[ProductProperty::RATING] = $this->productDetailGrabber->getRating($link);
        }

        return $productInfo;
    }

    /**
     * @param array<string> $productIds
     */
    public function getProducts(array $productIds): Iterator
    {
        foreach ($productIds as $productId) {
            yield $this->getProduct($productId);
        }
    }
}
