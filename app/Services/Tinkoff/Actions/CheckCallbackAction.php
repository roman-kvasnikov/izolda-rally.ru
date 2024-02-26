<?php

namespace App\Services\Tinkoff\Actions;

use App\Services\Tinkoff\Entities\PaymentEntity;
use App\Services\Tinkoff\Enums\PaymentStatusEnum;
use App\Services\Tinkoff\Exceptions\InvalidTokenException;
use App\Services\Tinkoff\TinkoffClient;
use App\Services\Tinkoff\TinkoffService;

class CheckCallbackAction
{
    public function __construct(
        private TinkoffService $tinkoff
    ) {
        //
    }

    public static function make(TinkoffService $tinkoff): static
    {
        return new static($tinkoff);
    }

    public function run(array $data): PaymentEntity
    {
        $token = TinkoffClient::make($this->tinkoff)
            ->createToken($data);

        if ($data['Token'] !== $token) {
            throw new InvalidTokenException('Token mismatch');
        }

        return new PaymentEntity(
            id: $data['PaymentId'],
            status: PaymentStatusEnum::from($data['Status']),
            order: $data['OrderId'],
            amount: $data['Amount']
        );
    }
}
