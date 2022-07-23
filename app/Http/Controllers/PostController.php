<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Theme;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $themes = Theme::all();
        $allPosts = array();

        foreach ($themes as $theme){
            $posts = Post::where('theme_id', '=', $theme->id)->orderByDesc('created_at')->get()->take(4);
            $allPosts[$theme->title] = $posts;
          }

        return view('posts.index', [
            'allPosts' => $allPosts,
        ]);
    }
}
