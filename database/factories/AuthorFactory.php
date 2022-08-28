<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Profile;
use Closure;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorFactory extends Factory
{
    public $model = 'Author';
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Author $author) {
            $profile = Profile::factory()->make();
            $author->profile()->save($profile);
        })->afterMaking(function (Author $author) {
               $profile = Profile::factory()->make();
               $author->profile()->save($profile);
           }) ;
    }
}
