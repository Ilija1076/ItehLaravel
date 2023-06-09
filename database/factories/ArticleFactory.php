<?php

namespace Database\Factories;
use App\Models\Profile;
use App\Models\Comment;
use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->sentence(),
            'slug'=>$this->faker->slug(),
            'content'=>$this->faker->paragraph(),
            'profile_id'=>Profile::factory(),
        ];
    }
}
