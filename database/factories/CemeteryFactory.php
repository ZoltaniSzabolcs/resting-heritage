<?php

namespace Database\Factories;

use App\Models\Cemetery;
use Clickbar\Magellan\Data\Geometries\LineString;
use Clickbar\Magellan\Data\Geometries\Point;
use Clickbar\Magellan\Data\Geometries\Polygon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cemetery>
 */
class CemeteryFactory extends Factory
{

    protected $model = Cemetery::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startPoint = Point::makeGeodetic($this->faker->latitude(), $this->faker->longitude());
        return [
            'name' => $this->faker->name(),
            'city' => $this->faker->city(),
            'description' => $this->faker->text(),
            'boundary' => Polygon::make(
                [LineString::make(
                    [
                        $startPoint,
                        Point::makeGeodetic($this->faker->latitude(), $this->faker->longitude()),
                        Point::makeGeodetic($this->faker->latitude(), $this->faker->longitude()),
                        $startPoint,
                    ]
                )],),
            'entrance' => Point::makeGeodetic($this->faker->latitude(), $this->faker->longitude()),
            'center' => Point::makeGeodetic($this->faker->latitude(), $this->faker->longitude()),
        ];
    }
}
