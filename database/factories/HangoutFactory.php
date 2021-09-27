<?php

namespace Database\Factories;

use App\Models\Hangout;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class HangoutFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Hangout::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::pluck('id')->toArray();
        $fake_extern_id = $this->faker->numberBetween(1, 999);
        $public = true;
        if( $fake_extern_id % 2 === 0 )
            $public = false;
        return [
            'extern_agenda_id' => $this->faker->numberBetween(1, 999),
            'extern_event_id' => $fake_extern_id,
            'creator_id' => $this->faker->randomElement($users),
            'public' => $public,
        ];
    }
}