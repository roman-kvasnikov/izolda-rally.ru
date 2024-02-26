<?php

namespace App\Services\Payments\Actions;

use App\Services\Payments\Models\Payment;

class GetPaymentsAction
{
    private ?string $uuid = null;

    public function uuid(string $uuid): static
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function first(): ?Payment
    {
        $query = Payment::query();

        if (! is_null($this->uuid)) {
            $query->where('uuid', $this->uuid);
        }

        return $query->first();
    }
}
