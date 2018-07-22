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
            'description' => '空と花畑の境界がわからなくなりますね。',
            'location' => 'Hitachi Kaihin Park',
            'camera' => 'Fujifilm X10',
            'lens' => 'Fujifilm X18-200mm f3.5-5.6 IS STM',
            'focal_length' => '18',
            'speed' => '1/200',
            'iris' => '3.5',
            'iso' => '200',
            'created_at' => '2018-6-19 17:53:21'
        ]);
        DB::table('photos')->insert([
            'user_id' => 2,
            'category_id' => 1,
            'title' => 'THE ORANGE',
            'path' => '2.JPG',
            'location' => 'シエラネバダ山脈',
            'camera' => 'CANON EOS 70D',
            'lens' => 'CANON EF-S 18-55mm IS STM',
            'focal_length' => '18',
            'speed' => '1/200',
            'iris' => '3.5',
            'iso' => '200',
            'created_at' => '2016-5-19 17:53:21'
        ]);
        DB::table('photos')->insert([
            'user_id' => 1,
            'category_id' => 1,
            'title' => 'Drop on leaf',
            'path' => '3.JPG',
            'location' => 'Tsukuba in Ibaraki Prefecture',
            'camera' => 'CANON EOS 8000D',
            'lens' => 'CANON EF 50mm II',
            'focal_length' => '50',
            'speed' => '1/200',
            'iris' => '2.2',
            'iso' => '200',
            'created_at' => '2016-5-19 17:53:21'
        ]);
    }
}
