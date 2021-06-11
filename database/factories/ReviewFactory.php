<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\Book;
use App\Models\Theme;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'book_id'=>Book::factory(),
            'theme_id'=>Theme::factory(),
            'review'=>$this->faker->realText(100),
            's_page'=>$this->faker->numberBetween($min=1, $max=10),
            'e_page'=>$this->faker->numberBetween($min=11, $max=20),
        ];
    }
}
