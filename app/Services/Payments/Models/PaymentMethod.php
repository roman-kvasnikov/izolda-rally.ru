<?php

namespace App\Services\Payments\Models;

use App\Services\Payments\Enums\PaymentDriverEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $name
 * @property bool $active
 * @property PaymentDriverEnum $driver
 * @property string $driver_currency_id
 */
class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'active', 'driver', 'driver_currency_id'];

    protected $casts = [
        'active' => 'boolean',
        'driver' => PaymentDriverEnum::class,
    ];
}
