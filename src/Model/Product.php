<?php

declare(strict_types=1);

namespace HPT\Model;

class Product
{
    private ?string $id = null;

    private ?float $price = null;

    private ?string $rating = null;

    private ?string $label = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id = null): self
    {
        $this->id = $id;

        return $this;
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

    public function getRating(): ?string
    {
        return $this->rating;
    }

    public function setRating(?string $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): self
    {
        $this->label = $label;

        return $this;
    }
}
