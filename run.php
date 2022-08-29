<?php

declare(strict_types=1);

use HPT\Factory\ProductFactory;
use HPT\Service\Dispatcher;
use HPT\Service\OutputGenerator;
use HPT\Service\ProductDetailGrabber;
use HPT\Service\ShopGrabber;
use PHPHtmlParser\Dom;

require_once __DIR__ . '/vendor/autoload.php';

error_reporting(E_ALL ^ E_DEPRECATED);

$productFactory = new ProductFactory();

$dom =new Dom();

$productDetailGrabber = new ProductDetailGrabber($dom);

$grabber = new ShopGrabber($productDetailGrabber,$productFactory,$dom);

$output = new OutputGenerator();

$dispatcher = new Dispatcher($grabber, $output);
$dispatcher->run();
