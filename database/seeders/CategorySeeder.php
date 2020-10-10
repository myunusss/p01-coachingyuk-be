<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [ 'user_id' => 1, 'name' => 'Popular', 'background' => 'categories/default/popular.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'deleted_at' => null ],
            [ 'user_id' => 1, 'name' => 'Fitness Habits', 'background' => 'categories/default/fitness.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'deleted_at' => null ],
            [ 'user_id' => 1, 'name' => 'Productivity Habits', 'background' => 'categories/default/productivity.png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'deleted_at' => null ],
            [ 'user_id' => 1, 'name' => 'Sleep Habits', 'background' => 'categories/default/sleeping.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'deleted_at' => null ],
            [ 'user_id' => 1, 'name' => 'Mindfulness & Positivity Habits', 'background' => 'categories/default/mindfull.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'deleted_at' => null ],
            [ 'user_id' => 1, 'name' => 'Practice Habits', 'background' => 'categories/default/forcing-kids-to-practice-music.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'deleted_at' => null ],
            [ 'user_id' => 1, 'name' => 'Lose Weight', 'background' => 'categories/default/lose_weight.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'deleted_at' => null ],
            [ 'user_id' => 1, 'name' => 'Nutrition Habits', 'background' => 'categories/default/nutrition.jpeg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'deleted_at' => null ],
            [ 'user_id' => 1, 'name' => 'Quit A Bad Habits', 'background' => 'categories/default/badhabit.jpeg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'deleted_at' => null ],
            [ 'user_id' => 1, 'name' => 'Learning Habits', 'background' => 'categories/default/learning-styles-header-overview.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'deleted_at' => null ],
            [ 'user_id' => 1, 'name' => 'Money Habits', 'background' => 'categories/default/travel-money-tips.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'deleted_at' => null ],
            [ 'user_id' => 1, 'name' => 'Special Guided Meditations', 'background' => 'categories/default/meditation.jpeg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'deleted_at' => null ],
            [ 'user_id' => 1, 'name' => 'Normal Guided Meditations', 'background' => 'categories/default/meditation.jpeg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'deleted_at' => null ],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert($category);
        }
    }
}
