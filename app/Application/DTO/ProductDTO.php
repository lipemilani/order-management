<?php

namespace App\Application\DTO;

use Illuminate\Http\UploadedFile;

class ProductDTO extends DataTransferObject
{
    public ?string $id;

    public ?string $name;

    public ?float $price;

    public ?UploadedFile $photo;

    public ?bool $active;
}
