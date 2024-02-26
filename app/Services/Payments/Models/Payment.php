<?php

namespace App\Services\Payments\Models;

use App\Services\Payments\Enums\PaymentDriverEnum;
use App\Services\Payments\Enums\PaymentStatusEnum;
use App\Support\Values\AmountValue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $uuid
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property PaymentStatusEnum $status
 * @property string $currency_id
 * @property AmountValue $amount
 * @property string $payable_type
 * @property int $payable_id
 * @property Payable $payable
 * @property int $method_id
 * @property PaymentMethod $method
 * @property PaymentDriverEnum|null $driver
 * @property string|null $driver_currency_id
 * @property AmountValue $driver_amount
 * @property string|null $driver_payment_id
 */
class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'status',
        'currency_id', 'amount',
        'payable_type', 'payable_id',
        'method_id',

        'driver',
        'driver_currency_id', 'driver_amount',
        'driver_payment_id',
    ];

    protected $casts = [
        'status' => PaymentStatusEnum::class,
        'amount' => AmountValue::class,
        'driver' => PaymentDriverEnum::class,
        'driver_amount' => AmountValue::class,
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function (Payment $payment) {
            if (empty($payment->uuid)) {
                $payment->uuid = (string) Str::uuid();
            }
        });
    }

    public function payable(): MorphTo
    {
        return $this->morphTo();
    }

    public function method(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
