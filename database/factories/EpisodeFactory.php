<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Episode>
 */
class EpisodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Episode: ' . $this->faker->unique()->word,
            'course_id' => \App\Models\Course::factory(),
            'section_id' => \App\Models\Section::factory(),
        ];
    }
}
