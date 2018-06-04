<?php

use Illuminate\Database\Seeder;

class PhotosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('photos')->insert([
            'user_id' => 1,
            'category_id' => 1,
            'title' => 'THE BLUE',
            'path' => '1.JPG'
        ]);
    }
}
