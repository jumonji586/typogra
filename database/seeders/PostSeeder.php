<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
            'description' => '悟空の持つカリスマ性をイメージして制作しました。',
            'user_id' => '2',
            'display_id' => 'abc1',
            'image_path' => '/storage/uploads/illust_image/sample1.jpg',
            'thumb_image_path' => '/storage/uploads/illust_thumb/sample1.jpg',
            'status' => '',
            'theme_id' => '1',
        ]);
        Post::create([
            'description' => 'いいね・コメント頂けると喜びます。',
            'user_id' => '2',
            'display_id' => 'abc2',
            'image_path' => '/storage/uploads/illust_image/sample2.jpg',
            'thumb_image_path' => '/storage/uploads/illust_thumb/sample2.jpg',
            'status' => '',
            'theme_id' => '1',
        ]);
        Post::create([
            'description' => '手書き',
            'user_id' => '2',
            'display_id' => 'abc3',
            'image_path' => '/storage/uploads/illust_image/sample3.jpg',
            'thumb_image_path' => '/storage/uploads/illust_thumb/sample3.jpg',
            'status' => '',
            'theme_id' => '1',
        ]);
        Post::create([
            'description' => '',
            'user_id' => '3',
            'display_id' => 'abc4',
            'image_path' => '/storage/uploads/illust_image/sample4.jpg',
            'thumb_image_path' => '/storage/uploads/illust_thumb/sample4.jpg',
            'status' => '',
            'theme_id' => '2',
        ]);
    }
}
