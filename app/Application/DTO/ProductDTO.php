<?php

namespace App\Application\DTO;

class ProductDTO extends DataTransferObject
{
    public ?string $id;

    public ?string $name;

    public ?float $price;

    public ?string $photo;

    public ?bool $active;
}
