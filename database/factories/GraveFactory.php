<?php

namespace Database\Factories;

use App\Models\Cemetery;
use App\Models\Grave;
use Clickbar\Magellan\Data\Geometries\Point;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Grave>
 */
class GraveFactory extends Factory
{

    protected $model = Grave::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cemetery_id' => Cemetery::factory(),
            'name' => $this->faker->regexify('[A-Z]-[0-9]{3}'),
            'location' => Point::makeGeodetic($this->faker->latitude(), $this->faker->longitude()),
        ];
    }
}
