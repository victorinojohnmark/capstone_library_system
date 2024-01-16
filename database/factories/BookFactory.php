<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'author' => $this->faker->name,
            'isbn' => $this->faker->isbn13,
            'publisher' => $this->faker->company,
            'category' => $this->faker->randomElement(['Books', 'Magazine', 'Journal']),
            'subject' => $this->faker->word,
            'year' => $this->faker->year,
            'quantity' => $this->faker->numberBetween(1, 100),
            'condition' => $this->faker->randomElement(['New','Fine', 'Good', 'Fair', 'Poor']),
        ];
    }
}
