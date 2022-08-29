<?php

declare(strict_types=1);

namespace HPT\Service;

use PHPHtmlParser\Dom;

class ProductDetailGrabber
{
    private const PRODUCT_DETAIL_URL = 'https://www.czc.cz/%s';

    private Dom $dom;

    public function __construct(Dom $dom)
    {
        $this->dom = $dom;
    }

    public function getRating(?string $link): ?string
    {
        $url = sprintf(self::PRODUCT_DETAIL_URL, $link);
        $this->dom->loadFromUrl($url);

        $ratingDom = $this->dom->find('.rating > .rating__label');

        if ($ratingDom->count() === 0) {
            return null;
        }

        /** @var  Dom\Node\AbstractNode $label */
        $rating = $ratingDom[0];

        return $rating->text;
    }

    public function getLabel(?string $link): ?string
    {
        $url = sprintf(self::PRODUCT_DETAIL_URL, $link);
        $this->dom->loadFromUrl($url);

        $labelDom = $this->dom->find('h1');

        if ($labelDom->count() === 0) {
            return null;
        }

        /** @var  Dom\Node\AbstractNode $label */
        $label = $labelDom[0];

        return $label->text;
    }
}