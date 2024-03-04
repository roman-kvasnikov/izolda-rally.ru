<?php

namespace App\Services\Merches\Factories;

use App\Services\Merches\Models\Merch;
use App\Support\Values\AmountValue;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Services\Merches\Models\Merch>
 */
class MerchFactory extends Factory
{
	protected $model = Merch::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'name' => $this->faker->sentence(3),
			'description' => $this->faker->text(500),
			'image' => str_replace('merches/', '', $this->faker->loremflickr('merches', 400, 500)),

			'price' => new AmountValue($this->faker->numberBetween(100, 5000)),
			'quantity' => $this->faker->numberBetween(0, 100),
			'is_published' => true
		];
	}
}
