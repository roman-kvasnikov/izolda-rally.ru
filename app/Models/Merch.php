<?php

namespace App\Models;

use App\Support\Values\AmountValue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property AmountValue $price
 * @property int $quantity
 * @property bool $is_published
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Merch extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',

        'price',
        'quantity',
        'is_published',
    ];

    protected $guarded = [];

    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'image' => 'string',

        'price' => AmountValue::class,
        'quantity' => 'integer',
        'is_published' => 'boolean',
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function toView(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image,

            'price' => $this->price->value(),
            'quantity' => $this->quantity,
        ];
    }

    protected static function booted(): void
    {
        static::addGlobalScope('is_published', function (Builder $builder) {
            $builder->where('is_published', true);
        });
    }
}
