<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MainListTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lists')->insert([
            [
                'user_id' => 1,
                'content' => 'test',
                'solution' => 'sol',
            ],
            [
                'user_id' => 1,
                'content' => 'test2',
                'solution' => 'sol2',
            ],
            [
                'user_id' => 1,
                'content' => 'test3',
                'solution' => 'sol3',
            ]
        ]);
    }
}
