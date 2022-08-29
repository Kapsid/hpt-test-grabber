<?php

declare(strict_types=1);

namespace HPT\Service;

class Dispatcher
{
    private Grabber $grabber;

    private Output $output;

    public function __construct(Grabber $grabber, Output $output)
    {
        $this->grabber = $grabber;
        $this->output = $output;
    }

    public function run(): bool
    {
        // TODO possible improvement - custom file input
        $source = 'resources/input.txt';
        $sourceByLines = file($source, FILE_IGNORE_NEW_LINES);

        $productInfo = $this->grabber->getProducts($sourceByLines);
        $output = $this->output->getJson($productInfo);
        fwrite(STDOUT, $output);

        return true;
    }
}
