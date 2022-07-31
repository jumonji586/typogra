<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Theme;
use App\Http\Requests\PostRequest;
use Faker\Core\Number;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $themes = Theme::orderByRaw('status is null asc')->orderBy("status", "asc")->get()->keyBy('id');
        // statusの値が小さい順、なおかつnullは後ろへ並べる

        $allPosts = array();

        foreach ($themes as $theme){
            $posts = Post::where('theme_id', '=', $theme->id)->orderByDesc('created_at')->get()->take(4);
            $allPosts[$theme->id] = $posts;
          }

        return view('posts.index', [
            'allPosts' => $allPosts,
            'themes' => $themes,
        ]);
    }
    public function create(?int $theme_id = null)
    {
        $themes = Theme::all();
        return view('posts.create', [
            'themes' => $themes,
            'theme_id' => $theme_id,
        ]);
    }
    public function store(PostRequest $request, Post $post)
    {

        [$save_image_path, $save_thumb_path] = $request->imageProcessing();

        $post->image_path = "/" . $save_image_path;
        $post->thumb_image_path = "/" . $save_thumb_path;

        $post->description = $request->description;
        $post->theme_id = $request->theme_id;

        $post->user_id = $request->user()->id;
        $post->save();
        $post->display_id = "a-" . dechex($post->id * 8888);
        $post->save();


        return redirect('/#new')->with('message', '投稿が完了しました');
    }
}
