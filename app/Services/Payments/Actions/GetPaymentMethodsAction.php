<?php

namespace App\Services\Payments\Actions;

use App\Services\Payments\Models\PaymentMethod;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class GetPaymentMethodsAction
{
    private ?string $currency = null;

    private ?bool $active = null;

    private ?int $id = null;

    public function currency(string $currency): static
    {
        $this->currency = $currency;

        return $this;
    }

    public function active(bool $active = true): static
    {
        $this->active = $active;

        return $this;
    }

    public function id(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function first(): ?PaymentMethod
    {
        return $this->query()->first();
    }

    public function get(): Collection
    {
        return $this->query()->get();
    }

    private function query(): Builder
    {
        $query = PaymentMethod::query();

        if (! is_null($this->currency)) {
            $query->where('driver_currency_id', $this->currency);
        }

        if (! is_null($this->active)) {
            $query->where('active', $this->active);
        }

        if (! is_null($this->id)) {
            $query->where('id', $this->id);
        }

        return $query;
    }
}
