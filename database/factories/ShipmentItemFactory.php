<?php

namespace Database\Factories;

use App\Models\ShipmentItem;
use Illuminate\Database\Eloquent\Factories\Factory;
;

class ShipmentItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ShipmentItem::class;

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
        'product_name' => $this->faker->word,
        'quantity' => $this->faker->randomDigitNotNull,
        'price_per_item' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'organization_id' => Organization::first()
        ];
    }
}
