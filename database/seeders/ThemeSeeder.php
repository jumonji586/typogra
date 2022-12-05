<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Theme;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Theme::create([
            'title' => '悟空',
        ]);
        Theme::create([
            'title' => 'ピーク時期',
        ]);
        Theme::create([
            'title' => '自由投稿（テーマ無し）',
        ]);
        Theme::create([
            'title' => 'google',
        ]);
    }
}
