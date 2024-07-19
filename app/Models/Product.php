<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Product
 * @package App\Domain\Models
 *
 * @property string $id
 * @property string $name
 * @property float $price
 * @property string $photo
 * @property bool $active
 */
class Product extends Model
{
    use HasUuids;
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'name' => 'string',
        'price' => 'float',
        'photo' => 'string',
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
        'price',
        'photo',
        'active',
    ];
}
