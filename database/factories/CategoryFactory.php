<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()

    {
        // dd('enter here');
        dd($this->faker->title);
        return [
            'name' => $this->faker->name,
        ];
    }
}