<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Video;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $likeableType_id = $this->likeableType_id();
        return [
            'user_id' => User::all()->random(1)->first()->id,
            'likeable_type' => $likeableType_id['type'],
            'likeable_id' => $likeableType_id['id'],
            'vote' => $this->faker->randomElement([1, -1])
        ];
    }

    private function likeableType_id()
    {
        $type = $this->faker->randomElement([
            Comment::class,
            Video::class
        ]);

        $id = $type == Comment::class ? Comment::all()->random(1)->first()->id : Video::all()->random(1)->first()->id;

        return [
            'type' => $type,
            'id' => $id
        ];
    }
}
