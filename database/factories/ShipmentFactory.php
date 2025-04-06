<?php

namespace Database\Factories;

use App\Models\Shipment;
use Illuminate\Database\Eloquent\Factories\Factory;
;

class ShipmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Shipment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => $this->faker->word,
        'shipment_date' => $this->faker->word,
        'is_completed' => $this->faker->word,
        'expected_arrival_date' => $this->faker->word,
        'arrival_date' => $this->faker->word,
        'reference_reciept' => $this->faker->word,
        'cbm' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'organization_id' => Organization::first()
        ];
    }
}
