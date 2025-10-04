<?php

namespace Database\Factories;

use App\Models\Grave;
use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{

    protected $model = Person::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $birthDate = $this->faker->dateTimeBetween('-200 years', '-150 years');
        $deathDate = $this->faker->dateTimeBetween($birthDate, 'now');

        return [
            'grave_id' => Grave::factory(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'initials' => $this->faker->randomElement(['Dr.', 'dr.', 'Gróf']),
            'birth_date' => $birthDate,
            'death_date' => $deathDate,
            'birth_place' => $this->faker->city(),
            'death_place' => $this->faker->city(),
            'biography' => $this->faker->paragraphs(3, true),
            'occupation' => $this->faker->jobTitle(),
            'image_url' => $this->faker->imageUrl(),
        ];
    }
}
