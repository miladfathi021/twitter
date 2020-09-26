<?php

namespace Database\Factories;

use App\Models\Auth\ApiToken;
use Illuminate\Database\Eloquent\Factories\Factory;

class TokenFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ApiToken::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => UserFactory::new()->create()->id,
            'api_token' => $this->faker->uuid,
        ];
    }
}
