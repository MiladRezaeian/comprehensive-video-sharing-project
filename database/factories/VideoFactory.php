<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Video>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $persianFaker = \Faker\Factory::create('fa_IR');

        return [
            'name' => $persianFaker->name(),
            'url' => $this->faker->imageUrl(640, 480, 'animals', true),
            'length' => $this->faker->randomNumber(3),
            'slug' => $this->faker->slug(),
            'description' => $persianFaker->realText(),
            'thumbnail' => 'https://loremflicker.com/446/240/world?random=' . rand(1, 99),
            'category_id' => Category::first() ?? Category::factory()
        ];
    }
}
