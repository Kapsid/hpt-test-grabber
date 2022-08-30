<?php

namespace App\Tests\HPT\Service;

use HPT\Service\ProductDetailGrabber;
use PHPHtmlParser\Dom;
use PHPUnit\Framework\TestCase;
//TODO improvement add test for price grabbing
final class ProductDetailGrabberTest extends TestCase
{

    public function testGetRating()
    {
        $dom = new Dom();
        $domResponse = $dom->loadFromFile(__DIR__.'/resource/test.html');
        $domFind = $domResponse->find('.rating > .rating__label');

        $domMock = $this->createPartialMock(Dom::class, ['loadFromUrl', 'find']);
        $domMock->method('loadFromUrl')->willReturn($domResponse);
        $domMock->method('find')->willReturn($domFind);

        $productGrabber = new ProductDetailGrabber($domMock);
        $result = $productGrabber->getRating('someString');

        $this->assertSame('98 %', $result);
    }

    public function testGetLabel()
    {
        $dom = new Dom();
        $domResponse = $dom->loadFromFile(__DIR__.'/resource/test.html');
        $domFind = $domResponse->find('h1');

        $domMock = $this->createPartialMock(Dom::class, ['loadFromUrl', 'find']);
        $domMock->method('loadFromUrl')->willReturn($domResponse);
        $domMock->method('find')->willReturn($domFind);

        $productGrabber = new ProductDetailGrabber($domMock);
        $result = $productGrabber->getRating('someString');

        $this->assertSame('Fractal Design Node 804', $result);
    }
}
