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
            'location' => Point::makeGeodetic(
                46.76345066378609 + (rand(-50, 50) * 0.0001),
                23.593751816660532 + (rand(-50, 50) * 0.0001)),
        ];
    }
}
