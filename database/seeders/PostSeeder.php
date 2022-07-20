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
            'title' => 'title1',
            'user_id' => '2',
            'display_id' => 'abc1',
            'thumb_image_path' => '/storage/uploads/illust_image/sample1.jpg',
            'image_path' => '/storage/uploads/illust_thumb/sample1.jpg',
            'status' => '',
            'theme_id' => '1',
        ]);
        Post::create([
            'title' => 'title2',
            'user_id' => '2',
            'display_id' => 'abc2',
            'thumb_image_path' => '/storage/uploads/illust_image/sample1.jpg',
            'image_path' => '/storage/uploads/illust_thumb/sample1.jpg',
            'status' => '',
            'theme_id' => '1',
        ]);
        Post::create([
            'title' => 'title2',
            'user_id' => '2',
            'display_id' => 'abc3',
            'thumb_image_path' => '/storage/uploads/illust_image/sample1.jpg',
            'image_path' => '/storage/uploads/illust_thumb/sample1.jpg',
            'status' => '',
            'theme_id' => '1',
        ]);
        Post::create([
            'title' => 'title2',
            'user_id' => '2',
            'display_id' => 'abc4',
            'thumb_image_path' => '/storage/uploads/illust_image/sample1.jpg',
            'image_path' => '/storage/uploads/illust_thumb/sample1.jpg',
            'status' => '',
            'theme_id' => '1',
        ]);
        Post::create([
            'title' => 'title2',
            'user_id' => '2',
            'display_id' => 'abc5',
            'thumb_image_path' => '/storage/uploads/illust_image/sample1.jpg',
            'image_path' => '/storage/uploads/illust_thumb/sample1.jpg',
            'status' => '',
            'theme_id' => '1',
        ]);
        Post::create([
            'title' => 'title2',
            'user_id' => '2',
            'display_id' => 'abc6',
            'thumb_image_path' => '/storage/uploads/illust_image/sample1.jpg',
            'image_path' => '/storage/uploads/illust_thumb/sample1.jpg',
            'status' => '',
            'theme_id' => '2',
        ]);
        Post::create([
            'title' => 'title2',
            'user_id' => '2',
            'display_id' => 'abc7',
            'thumb_image_path' => '/storage/uploads/illust_image/sample1.jpg',
            'image_path' => '/storage/uploads/illust_thumb/sample1.jpg',
            'status' => '',
            'theme_id' => '2',
        ]);
        Post::create([
            'title' => 'title2',
            'user_id' => '2',
            'display_id' => 'abc8',
            'thumb_image_path' => '/storage/uploads/illust_image/sample1.jpg',
            'image_path' => '/storage/uploads/illust_thumb/sample1.jpg',
            'status' => '',
            'theme_id' => '1',
        ]);
        Post::create([
            'title' => 'title2',
            'user_id' => '2',
            'display_id' => 'abc9',
            'thumb_image_path' => '/storage/uploads/illust_image/sample1.jpg',
            'image_path' => '/storage/uploads/illust_thumb/sample1.jpg',
            'status' => '',
            'theme_id' => '1',
        ]);
        Post::create([
            'title' => 'title2',
            'user_id' => '2',
            'display_id' => 'abc10',
            'thumb_image_path' => '/storage/uploads/illust_image/sample1.jpg',
            'image_path' => '/storage/uploads/illust_thumb/sample1.jpg',
            'status' => '',
            'theme_id' => '3',
        ]);
    }
}
