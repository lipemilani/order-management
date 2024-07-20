<?php

namespace App\Application\DTO;

class ProductDTO extends DataTransferObject
{
    public ?int $id;

    public ?string $name;

    public ?float $price;

    public ?string $photo;

    public ?bool $active;

}
