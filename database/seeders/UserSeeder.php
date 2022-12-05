<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
            'email' => 'sample@co.jp',
            'display_id' => 'u-fhi1',
            'password' => '$2y$10$yqYkn0tJnYiN50aySSOFye58Fp2pEjJ.0Ugun/MZmCw7lY95TkfqC',
            'prof_image_path' => '/img/prof-image-default/1.jpg',
            'provider_name' => '',
            'provider_id' => '',
            'prof_text' => '宜しくお願いします！',
            'role' => '',
        ]);
        User::create([
            'name' => '山田太郎',
            'email' => 'sample2@co.jp',
            'display_id' => 'u-sdf5',
            'password' => '$2y$10$yqYkn0tJnYiN50aySSOFye58Fp2pEjJ.0Ugun/MZmCw7lY95TkfqC',
            'prof_image_path' => '/img/prof-image-default/2.jpg',
            'provider_name' => '',
            'provider_id' => '',
            'prof_text' => '宜しくお願いします！',
            'role' => '',
        ]);
        User::create([
            'name' => 'thankyoufortheearth',
            'email' => 'sample3@co.jp',
            'display_id' => 'u-22k4',
            'password' => '$2y$10$yqYkn0tJnYiN50aySSOFye58Fp2pEjJ.0Ugun/MZmCw7lY95TkfqC',
            'prof_image_path' => '/img/prof-image-default/3.jpg',
            'provider_name' => '',
            'provider_id' => '',
            'prof_text' => '宜しくお願いします！',
            'role' => '',
        ]);
        User::create([
            'name' => 'りんご',
            'email' => 'sample4@co.jp',
            'display_id' => 'u-k9uj',
            'password' => '$2y$10$yqYkn0tJnYiN50aySSOFye58Fp2pEjJ.0Ugun/MZmCw7lY95TkfqC',
            'prof_image_path' => '/img/prof-image-default/4.jpg',
            'provider_name' => '',
            'provider_id' => '',
            'prof_text' => '宜しくお願いします！',
            'role' => '',
        ]);
        User::create([
            'name' => '雄太',
            'email' => 'sample5@co.jp',
            'display_id' => 'u-p09e',
            'password' => '$2y$10$yqYkn0tJnYiN50aySSOFye58Fp2pEjJ.0Ugun/MZmCw7lY95TkfqC',
            'prof_image_path' => '/img/prof-image-default/5.jpg',
            'provider_name' => '',
            'provider_id' => '',
            'prof_text' => '宜しくお願いします！',
            'role' => '',
        ]);
        User::create([
            'name' => 'sachiko',
            'email' => 'sample6@co.jp',
            'display_id' => 'u-1hg8',
            'password' => '$2y$10$yqYkn0tJnYiN50aySSOFye58Fp2pEjJ.0Ugun/MZmCw7lY95TkfqC',
            'prof_image_path' => '/img/prof-image-default/7.jpg',
            'provider_name' => '',
            'provider_id' => '',
            'prof_text' => '宜しくお願いします！',
            'role' => '',
        ]);
        User::create([
            'name' => '新之助',
            'email' => 'sample7@co.jp',
            'display_id' => 'u-77uh',
            'password' => '$2y$10$yqYkn0tJnYiN50aySSOFye58Fp2pEjJ.0Ugun/MZmCw7lY95TkfqC',
            'prof_image_path' => '/img/prof-image-default/8.jpg',
            'provider_name' => '',
            'provider_id' => '',
            'prof_text' => '宜しくお願いします！',
            'role' => '',
        ]);
        User::create([
            'name' => '山田太郎@就活中',
            'email' => 'sample8@co.jp',
            'display_id' => 'u-las9',
            'password' => '$2y$10$yqYkn0tJnYiN50aySSOFye58Fp2pEjJ.0Ugun/MZmCw7lY95TkfqC',
            'prof_image_path' => '/img/prof-image-default/9.jpg',
            'provider_name' => '',
            'provider_id' => '',
            'prof_text' => '',
            'role' => '',
        ]);
        User::create([
            'name' => 'CHIKA',
            'email' => 'sample9@co.jp',
            'display_id' => 'u-t8k0',
            'password' => '$2y$10$yqYkn0tJnYiN50aySSOFye58Fp2pEjJ.0Ugun/MZmCw7lY95TkfqC',
            'prof_image_path' => '/img/prof-image-default/10.jpg',
            'provider_name' => '',
            'provider_id' => '',
            'prof_text' => '宜しくお願いします！',
            'role' => '',
        ]);
        User::create([
            'name' => '鹿',
            'email' => 'sample10@co.jp',
            'display_id' => 'u-g3e4',
            'password' => '$2y$10$yqYkn0tJnYiN50aySSOFye58Fp2pEjJ.0Ugun/MZmCw7lY95TkfqC',
            'prof_image_path' => '/img/prof-image-default/6.jpg',
            'provider_name' => '',
            'provider_id' => '',
            'prof_text' => '宜しくお願いします！',
            'role' => '',
        ]);
    }
}
