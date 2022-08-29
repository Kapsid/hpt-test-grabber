<?php

declare(strict_types=1);

use \HPT\Factory\ProductFactory;
use \HPT\Service\Dispatcher;
use \HPT\Service\JsonOutput;
use HPT\Service\OutputGenerator;
use \HPT\Service\ShopGrabber;
use PHPHtmlParser\Dom;

require_once __DIR__ . '/vendor/autoload.php';

error_reporting(E_ALL ^ E_DEPRECATED);

$productFactory = new ProductFactory();

$grabber = new ShopGrabber($productFactory, new Dom());

$output = new OutputGenerator();

$dispatcher = new Dispatcher($grabber, $output);
$dispatcher->run();
