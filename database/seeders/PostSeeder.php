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
            'description' => 'description1',
            'user_id' => '2',
            'display_id' => 'abc1',
            'image_path' => '/storage/uploads/illust_image/sample1.jpg',
            'thumb_image_path' => '/storage/uploads/illust_thumb/sample1.jpg',
            'status' => '',
            'theme_id' => '1',
        ]);
        Post::create([
            'description' => 'description2',
            'user_id' => '2',
            'display_id' => 'abc2',
            'image_path' => '/storage/uploads/illust_image/sample1.jpg',
            'thumb_image_path' => '/storage/uploads/illust_thumb/sample1.jpg',
            'status' => '',
            'theme_id' => '1',
        ]);
        Post::create([
            'description' => 'description2',
            'user_id' => '2',
            'display_id' => 'abc3',
            'image_path' => '/storage/uploads/illust_image/sample1.jpg',
            'thumb_image_path' => '/storage/uploads/illust_thumb/sample1.jpg',
            'status' => '',
            'theme_id' => '1',
        ]);
        Post::create([
            'description' => 'description2',
            'user_id' => '2',
            'display_id' => 'abc4',
            'image_path' => '/storage/uploads/illust_image/sample1.jpg',
            'thumb_image_path' => '/storage/uploads/illust_thumb/sample1.jpg',
            'status' => '',
            'theme_id' => '1',
        ]);
        Post::create([
            'description' => 'description2',
            'user_id' => '2',
            'display_id' => 'abc5',
            'image_path' => '/storage/uploads/illust_image/sample1.jpg',
            'thumb_image_path' => '/storage/uploads/illust_thumb/sample1.jpg',
            'status' => '',
            'theme_id' => '1',
        ]);
        Post::create([
            'description' => 'description2',
            'user_id' => '2',
            'display_id' => 'abc6',
            'image_path' => '/storage/uploads/illust_image/sample1.jpg',
            'thumb_image_path' => '/storage/uploads/illust_thumb/sample1.jpg',
            'status' => '',
            'theme_id' => '2',
        ]);
        Post::create([
            'description' => 'description2',
            'user_id' => '2',
            'display_id' => 'abc7',
            'image_path' => '/storage/uploads/illust_image/sample1.jpg',
            'thumb_image_path' => '/storage/uploads/illust_thumb/sample1.jpg',
            'status' => '',
            'theme_id' => '2',
        ]);
        Post::create([
            'description' => 'description2',
            'user_id' => '2',
            'display_id' => 'abc8',
            'image_path' => '/storage/uploads/illust_image/sample1.jpg',
            'thumb_image_path' => '/storage/uploads/illust_thumb/sample1.jpg',
            'status' => '',
            'theme_id' => '1',
        ]);
        Post::create([
            'description' => 'description2',
            'user_id' => '2',
            'display_id' => 'abc9',
            'image_path' => '/storage/uploads/illust_image/sample1.jpg',
            'thumb_image_path' => '/storage/uploads/illust_thumb/sample1.jpg',
            'status' => '',
            'theme_id' => '1',
        ]);
        Post::create([
            'description' => 'description2',
            'user_id' => '2',
            'display_id' => 'abc10',
            'image_path' => '/storage/uploads/illust_image/sample1.jpg',
            'thumb_image_path' => '/storage/uploads/illust_thumb/sample1.jpg',
            'status' => '',
            'theme_id' => '3',
        ]);
    }
}
