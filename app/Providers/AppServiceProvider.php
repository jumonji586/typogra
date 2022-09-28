<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (Schema::hasTable('users')) {
            $rankUsers = User::withCount(['posts', 'likesOfUser'])->orderByDesc('likes_of_user_count')->get()->take(10);
            view()->share('rankUsers', $rankUsers);
        }
        if (Schema::hasTable('posts')) {
            $recommendPosts = Post::where('status', '=', 'recommend')->inRandomOrder()->get();
            $recommendPosts4 = $recommendPosts->take(4);
            $recommendPosts6 = $recommendPosts->take(6);
            $recommendPosts8 = $recommendPosts->take(8);
            $newPosts = Post::all()->sortByDesc('created_at')->take(8);

            view()->share([
                'recommendPosts4' => $recommendPosts4,
                'recommendPosts6' => $recommendPosts6,
                'recommendPosts8' => $recommendPosts8,
                'newPosts' => $newPosts,
            ]);
        }
    }
}
