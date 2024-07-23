<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Orders
 * @package App\Domain\Models
 *
 * @property string $id
 * @property string $customer_id
 * @property string $product_id
 * @property Carbon $created_at
 * @property bool $active
 */
class Order extends Model
{
    use HasUuids;
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'orders';

    protected $keyType = 'string';

    public $timestamps = false;

    public $incrementing = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'customer_id' => 'string',
        'product_id' => 'string',
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
        'customer_id',
        'product_id',
        'created_at',
        'active',
    ];

    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function products(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
