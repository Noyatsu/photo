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
            'name' => 'テスト太郎'
        ]);
    }
}
