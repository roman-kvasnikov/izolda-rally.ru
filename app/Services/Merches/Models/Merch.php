<?php

namespace App\Services\Merches\Models;

use App\Services\Carts\Models\Cart;
use App\Services\Merches\Factories\MerchFactory;
use App\Support\Values\AmountValue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

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
	use HasFactory;

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

	protected static function newFactory(): Factory
	{
		return MerchFactory::new();
	}

	public function carts(): HasMany
	{
		return $this->hasMany(Cart::class);
	}

	public function toView(): array
	{
		return [
			'id'			=> $this->id,
			'name'			=> $this->name,
			'description'	=> $this->description,
			'image'			=> Storage::url('merches/' . $this->image),

			'price'			=> [
				'value'			=> convert($this->price)->value(),
				'formatted'		=> money(convert($this->price), currency())
			],
			'quantity'		=> $this->quantity
		];
	}

	protected static function booted(): void
	{
		static::addGlobalScope('is_published', function (Builder $builder) {
			$builder->where('is_published', true);
		});
	}
}
