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
            'path' => '1.JPG',
            'location' => 'Hitachi Kaihin Park',
            'camera' => 'Fujifilm X10',
            'lens' => 'Fujifilm X18-200mm f3.5-5.6 IS STM',
            'focal_length' => '18',
            'speed' => '1/200',
            'iris' => '3.5',
            'iso' => '200',
            'created_at' => '2018-6-19 17:53:21'
        ]);
    }
}
