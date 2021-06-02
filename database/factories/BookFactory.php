<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Theme;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'theme_id'=>Theme::factory(),
            'name'=>$this->faker->realText($maxNbChars = 10),
            'title'=>$this->faker->realText($maxNbChars = 25),
            'publisher'=>$this->faker->realText($maxNbChars = 25),
            'year'=>$this->faker->numberBetween($min=1940, $max=2020),
        ];
    }
}
