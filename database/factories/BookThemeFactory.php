<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Theme;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookThemeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Model::class;

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
        ];
    }
}
