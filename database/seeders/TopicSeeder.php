<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $topics = [
            [ 'id' => 1, 'category_id' => 4, 'user_id' => 1, 'name' => 'Drink More Water', 'slug' => 'drink-more-water', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'deleted_at' => null, 'background' => null ],
            [ 'id' => 2, 'category_id' => 4, 'user_id' => 1, 'name' => 'Exercise', 'slug' => 'exercise', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'deleted_at' => null, 'background' => null ],
            [ 'id' => 3, 'category_id' => 4, 'user_id' => 1, 'name' => 'Read', 'slug' => 'read', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'deleted_at' => null, 'background' => null ],
            [ 'id' => 4, 'category_id' => 5, 'user_id' => 1, 'name' => 'Exercise', 'slug' => 'exercise-1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'deleted_at' => null, 'background' => null ],
            [ 'id' => 5, 'category_id' => 5, 'user_id' => 1, 'name' => 'Run', 'slug' => 'run', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'deleted_at' => null, 'background' => null ],
            [ 'id' => 6, 'category_id' => 5, 'user_id' => 1, 'name' => 'Go to Gym', 'slug' => 'go-to-gym', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'deleted_at' => null, 'background' => null ],
            [ 'id' => 7, 'category_id' => 6, 'user_id' => 1, 'name' => 'Set Priorities For Your Day', 'slug' => 'set-priorities-for-your-day', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'deleted_at' => null, 'background' => null ],
            [ 'id' => 8, 'category_id' => 6, 'user_id' => 1, 'name' => 'Write To Do List', 'slug' => 'write-to-do-list', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'deleted_at' => null, 'background' => null ],
            [ 'id' => 9, 'category_id' => 6, 'user_id' => 1, 'name' => 'Inbox Zero', 'slug' => 'inbox-zero', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'deleted_at' => null, 'background' => null ],
        ];

        foreach ($topics as $topic) {
            DB::table('topics')->insert($topic);
        }
    }
}
