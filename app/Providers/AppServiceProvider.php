<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Post;
use App\Models\Theme;
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
        if (Schema::hasTable('themes')) {
            $themeList = Theme::all();
            view()->share('themeList', $themeList);
        }
        // config('app.url') が https 始まりか？http 始まりか？ をもとに強制的に scheme を設定する
        \Illuminate\Support\Facades\URL::forceScheme(\Illuminate\Support\Str::startsWith(config('app.url'), 'https') ? 'https' : 'http');
    }
}
