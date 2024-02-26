<?php

namespace App\Services\Orders\Models;

use App\Services\Orders\Enums\OrderStatusEnum;
use App\Services\Orders\OrderService;
use App\Services\Payments\Contracts\Payable;
use App\Support\Values\AmountValue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $uuid
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property OrderStatusEnum $status
 * @property Currency $currency_id
 * @property Cart $cart_session_id
 * @property AmountValue $amount
 * @property string $full_name
 * @property string $email
 * @property string $phone
 * @property string $city
 * @property string $note
 */
class Order extends Model implements Payable
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'status',
        'currency_id',
        'cart_session_id',
        'amount',

        'full_name',
        'email',
        'phone',
        'city',
        'note',
    ];

    protected $casts = [
        'status' => OrderStatusEnum::class,
        'amount' => AmountValue::class,
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function (Order $order) {
            if (empty($order->uuid)) {
                $order->uuid = (string) Str::uuid();
            }
        });
    }

    public function getPayableName(): string
    {
        return 'Заказ '.$this->uuid;
    }

    public function getPayableCurrencyId(): string
    {
        return $this->currency_id;
    }

    public function getPayableAmount(): AmountValue
    {
        return $this->amount;
    }

    public function getPayableType(): string
    {
        return $this->getMorphClass(); // 'order'
    }

    public function getPayableId(): int
    {
        return $this->id;
    }

    public function getPayableUrl(): string
    {
        return route('orders.show', $this->uuid);
    }

    public function onPaymentComplete(): void
    {
        (new OrderService)->completeOrder()->run($this);
    }
}
