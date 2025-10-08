<?php

namespace Database\Factories;

use App\Models\Cemetery;
use App\Models\Grave;
use Clickbar\Magellan\Data\Geometries\LineString;
use Clickbar\Magellan\Data\Geometries\Point;
use Clickbar\Magellan\Data\Geometries\Polygon;
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
        $lat = 46.76345066378609 + (rand(-35, 35) * 0.0001);
        $lng = 23.593751816660532 + (rand(-35, 35) * 0.0001);
        $location = Point::makeGeodetic($lat, $lng);
        return [
            'cemetery_id' => Cemetery::factory(),
            'name' => $this->faker->regexify('[A-Z]-[0-9]{3}'),
            'location' => $location,
            'boundary' => Polygon::make(
                [LineString::make(
                    [
                        $location,
                        Point::makeGeodetic($lat + (rand(-5,5) * 0.00001), $lng + rand(-5, 5) * 0.00001),
                        Point::makeGeodetic($lat + (rand(-5,5) * 0.00001), $lng + rand(-5, 5) * 0.00001),
                        Point::makeGeodetic($lat + (rand(-5,5) * 0.00001), $lng + rand(-5, 5) * 0.00001),
                        $location,
                    ]
                )]
            )
        ];
    }
}
