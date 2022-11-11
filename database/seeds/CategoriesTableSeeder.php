<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'user_id' => 1,
            'name' => 'サンプル1',
            'category_id' => 0,
        ]);
    }
}
