<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class RecordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('records')->insert([
            'user_id' => 1,
            'category_id' => 0,
            'remind_date' => '2022-11-04',
            'title' => 'サンプル1',
            'text' => 'サンプル1',
            'image' => 'サンプル1',
            'release_flg' => 0,
            'opened_flg' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
