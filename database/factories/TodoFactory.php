<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Todo;
use Illuminate\Support\Str;

class TodoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Todo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = \App\Models\User::all()->pluck('id')->toArray();

        return [
            'user_id' => $this->faker->randomElements($users),
            'title' => $this->faker->word(\mt_rand(3, 8)),
            'description' => $this->faker->paragraph()
        ];
    }
}
