<?php

namespace App\Services\Carts\Models;

use App\Services\Merches\Models\Merch;
use App\Support\Values\AmountValue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id
 * @property string $session_id
 * @property Merch $merch_id
 * @property int $quantity
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Cart extends Model
{
	protected $fillable = [
		'session_id',
		'merch_id',
		'quantity',
	];

	protected $guarded = [];

	protected $casts = [
		'session_id' => 'string',
		'merch_id' => 'integer',
		'quantity' => 'integer',
	];

	public function merch(): BelongsTo
	{
		return $this->belongsTo(Merch::class);
	}

	public function toView(): array
	{
		return [
			'id'		=> $this->id,
			'merch'		=> [
				'id'			=> $this->merch->id,
				'name'			=> $this->merch->name,
				'description'	=> $this->merch->description,
				'image'			=> Storage::url('merches/' . $this->merch->image),

				'price'			=> [
					'value'			=> convert($this->merch->price)->value(),
					'formatted'		=> money(convert($this->merch->price), currency())
				],
				'quantity'		=> $this->merch->quantity,
				'total_price'	=> [
					'value'			=> convert($this->merch->price->mul(new AmountValue($this->quantity)))->value(),
					'formatted'		=> money(convert($this->merch->price->mul(new AmountValue($this->quantity))), currency())
				]
			],
			'quantity'	=> $this->quantity,
		];
	}

	public static function boot()
	{
		parent::boot();

		static::creating(function (Cart $cart) {
			if (empty($cart->session_id)) {
				$cart->session_id = static::getCartSessionId();
			}
		});
	}

	protected static function booted(): void
	{
		static::addGlobalScope('session_id', function (Builder $builder) {
			$builder->where('session_id', static::getCartSessionId());
		});
	}

	private static function getCartSessionId()
	{
		if (!Cookie::has('cart_session_id')) {
			$cartSessionId = session()->getId();

			Cookie::queue(Cookie::make('cart_session_id', $cartSessionId, 2628000));
		} else {
			$cartSessionId = Cookie::get('cart_session_id');
		}

		return $cartSessionId;
	}
}
