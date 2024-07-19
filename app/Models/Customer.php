<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Customer
 * @package App\Domain\Models
 *
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property Carbon $date_of_birth
 * @property string $address
 * @property string $complement
 * @property string $neighborhood
 * @property string $cep
 * @property Carbon $created_at
 * @property bool $active
 */
class Customer extends Model
{
    use HasUuids;
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'customers';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'name' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'date_of_birth' => 'datetime',
        'address' => 'string',
        'complement' => 'string',
        'neighborhood' => 'string',
        'cep' => 'string',
        'created_at' => 'datetime',
        'active' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'date_of_birth',
        'address',
        'complement',
        'neighborhood',
        'cep',
        'created_at',
        'active',
    ];
}
