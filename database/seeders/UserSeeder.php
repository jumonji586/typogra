<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'taro1',
            'email' => '1@jojo',
            'display_id' => 'abc1',
            'password' => '',
            'prof_image_path' => '/storage/uploads/illust_thumb/sample1.jpg',
            'provider_name' => '',
            'provider_id' => '',
            'prof_text' => '',
            'role' => '',
        ]);
        User::create([
            'name' => 'taro2',
            'email' => '2@jojo',
            'display_id' => 'abc2',
            'password' => '',
            'prof_image_path' => '/storage/uploads/illust_thumb/sample1.jpg',
            'provider_name' => '',
            'provider_id' => '',
            'prof_text' => '',
            'role' => '',
        ]);
        User::create([
            'name' => 'taro3',
            'email' => '3@jojo',
            'display_id' => 'abc3',
            'password' => '',
            'prof_image_path' => '/storage/uploads/illust_thumb/sample1.jpg',
            'provider_name' => '',
            'provider_id' => '',
            'prof_text' => '',
            'role' => '',
        ]);
    }
}
