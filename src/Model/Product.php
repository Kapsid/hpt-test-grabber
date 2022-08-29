<?php

declare(strict_types=1);

namespace HPT\Model;

class Product
{
    private string $id;
    private ?float $price = null;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price = null): self
    {
        $this->price = $price;
        return $this;
    }
}
