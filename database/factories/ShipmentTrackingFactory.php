<?php

namespace Database\Factories;

use App\Models\ShipmentTracking;
use Illuminate\Database\Eloquent\Factories\Factory;
;

class ShipmentTrackingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ShipmentTracking::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'shipment_id' => $this->faker->word,
        'display_ordinal' => $this->faker->randomDigitNotNull,
        'name' => $this->faker->word,
        'current_location' => $this->faker->word,
        'next_destination' => $this->faker->word,
        'status' => $this->faker->word,
        'expected_depature_date' => $this->faker->word,
        'expected_arrival_date' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'organization_id' => Organization::first()
        ];
    }
}
