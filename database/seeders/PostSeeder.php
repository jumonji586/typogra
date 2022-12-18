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
            'description' => '悟空の持つカリスマ性をイメージして作成しました。',
            'user_id' => '2',
            'display_id' => 'a-kdjd6',
            'image_path' => '/storage/uploads/illust_image/sample1',
            'thumb_image_path' => '/storage/uploads/illust_thumb/sample1',
            'large_thumb_image_path' => '/storage/uploads/illust_large_thumb/sample1',
            'status' => 'recommend',
            'theme_id' => '1',
        ]);
        Post::create([
            'description' => 'いいね・コメント頂けると喜びます。',
            'user_id' => '2',
            'display_id' => 'a-l0sd7d',
            'image_path' => '/storage/uploads/illust_image/sample2',
            'thumb_image_path' => '/storage/uploads/illust_thumb/sample2',
            'large_thumb_image_path' => '/storage/uploads/illust_large_thumb/sample2',
            'status' => 'recommend',
            'theme_id' => '1',
        ]);
        Post::create([
            'description' => '',
            'user_id' => '2',
            'display_id' => 'a-dd91j7',
            'image_path' => '/storage/uploads/illust_image/sample3',
            'thumb_image_path' => '/storage/uploads/illust_thumb/sample3',
            'large_thumb_image_path' => '/storage/uploads/illust_large_thumb/sample3',
            'status' => 'recommend',
            'theme_id' => '1',
        ]);
        Post::create([
            'description' => '',
            'user_id' => '3',
            'display_id' => 'a-sdfa0h',
            'image_path' => '/storage/uploads/illust_image/sample4',
            'thumb_image_path' => '/storage/uploads/illust_thumb/sample4',
            'large_thumb_image_path' => '/storage/uploads/illust_large_thumb/sample4',
            'status' => 'recommend',
            'theme_id' => '1',
        ]);
        Post::create([
            'description' => '',
            'user_id' => '3',
            'display_id' => 'a-23dgfd',
            'image_path' => '/storage/uploads/illust_image/sample5',
            'thumb_image_path' => '/storage/uploads/illust_thumb/sample5',
            'large_thumb_image_path' => '/storage/uploads/illust_large_thumb/sample5',
            'status' => 'recommend',
            'theme_id' => '2',
        ]);
        Post::create([
            'description' => '',
            'user_id' => '3',
            'display_id' => 'a-kt3js',
            'image_path' => '/storage/uploads/illust_image/sample6',
            'thumb_image_path' => '/storage/uploads/illust_thumb/sample6',
            'large_thumb_image_path' => '/storage/uploads/illust_large_thumb/sample6',
            'status' => 'recommend',
            'theme_id' => '2',
        ]);
        Post::create([
            'description' => 'マザー牧場',
            'user_id' => '4',
            'display_id' => 'a-kdk99',
            'image_path' => '/storage/uploads/illust_image/sample7',
            'thumb_image_path' => '/storage/uploads/illust_thumb/sample7',
            'large_thumb_image_path' => '/storage/uploads/illust_large_thumb/sample7',
            'status' => 'recommend',
            'theme_id' => '3',
        ]);
    }
}
