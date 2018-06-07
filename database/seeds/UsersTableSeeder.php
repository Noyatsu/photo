<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'test@test.ne.jp',
            'password' => bcrypt('testtest'),
            'screen_name' => 'test_test_test',
            'name' => 'テスト太郎',
            'description' => 'こんにちは，テスト太郎です．実験的なこと，いわゆるテストが大好きです．よろしくお願いします．'
        ]);
        DB::table('users')->insert([
            'email' => 'test2@test.ne.jp',
            'password' => bcrypt('testtest'),
            'screen_name' => 'test_test_test2',
            'name' => 'テスト次郎',
            'description' => 'こんにちは，テスト次郎です．実験的なこと，いわゆる次郎系が大好きです．よろしくお願いします．'
        ]);
    }
}
