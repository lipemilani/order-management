<?php

namespace App\Application\DTO;

use Carbon\Carbon;

class CustomerDTO extends DataTransferObject
{
    public ?int $id;

    public ?string $name;

    public ?string $email;

    public ?string $phone;

    public ?Carbon $dateOfBirth;

    public ?string $address;

    public ?string $complement;

    public ?string $neighborhood;

    public ?string $cep;

    public ?Carbon $createdAt;

    public ?bool $active;


}
