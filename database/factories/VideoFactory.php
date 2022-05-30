<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'url' => 'https://www.aparat.com/v/Umk1a',
            'length' => $this->faker->randomNumber(3),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->realText(),
            'thumbnail' => 'https://loremflickr.com/446/240/world?random=' . rand(1, 99),
            'category_id' => Category::all()->random(1)->first()->id
        ];
    }
}
