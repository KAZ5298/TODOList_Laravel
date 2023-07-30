<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('items')->insert([
            [
                'user_id' => 1,
                'item_name' => 'test1',
                'registration_date' => '2023-07-28',
                'expire_date' => '2023-07-28',
                'finished_date' => null,
                'is_deleted' => 0,
            ],
            [
                'user_id' => 2,
                'item_name' => 'test2',
                'registration_date' => '2023-07-28',
                'expire_date' => '2023-07-28',
                'finished_date' => null,
                'is_deleted' => 0,
            ],
            [
                'user_id' => 1,
                'item_name' => 'test3',
                'registration_date' => '2023-07-28',
                'expire_date' => '2023-07-28',
                'finished_date' => '2023-07-28',
                'is_deleted' => 0,
            ],
            [
                'user_id' => 3,
                'item_name' => 'test4',
                'registration_date' => '2023-07-28',
                'expire_date' => '2023-07-28',
                'finished_date' => null,
                'is_deleted' => 0,
            ],
            [
                'user_id' => 2,
                'item_name' => 'test5',
                'registration_date' => '2023-07-28',
                'expire_date' => '2023-07-28',
                'finished_date' => null,
                'is_deleted' => 1,
            ]
        ]);
    }
}