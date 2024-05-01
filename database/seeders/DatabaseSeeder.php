<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Episode;
use App\Models\Section;
use App\Models\Topic;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Topic::factory(3)->create();

        Topic::all()->each(function (Topic $topic): void {
            $topic->courses()->createMany(
                Course::factory(fake()->numberBetween(2, 5))->make([
                    'topic_id' => $topic->id,
                ])->toArray()
            );
        });

        Course::all()->each(function (Course $course): void {
            $course->sections()->createMany(
                Section::factory(fake()->numberBetween(2, 5))->make([
                    'course_id' => $course->id,
                ])->toArray()
            );
        });

        Section::all()->each(function (Section $section): void {
            $section->episodes()->createMany(
                Episode::factory(fake()->numberBetween(2, 5))->make([
                    'section_id' => $section->id,
                    'course_id' => $section->course_id,
                ])->toArray()
            );
        });
    }
}
