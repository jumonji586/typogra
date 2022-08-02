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
    public function show(string $display_id, Post $post)
    {
        $targetPost = Post::where('display_id', $display_id)->first();
 
        // $imgSize = getimagesize((empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $targetPost->image_path);
        // XAMPP環境だと↑でOKだったがdockerだとエラー出たのでいったん↓に変更。
        $imgSize = getimagesize(ltrim($targetPost->image_path, '/'));
        
        $aspect = $imgSize[0] / $imgSize[1];
        if ($aspect > 1.5) {
            $imgClass = "wide-img";
        } elseif ($aspect < 0.8) {
            $imgClass = "heigh-img";
        }else{
            $imgClass = null;
        }
        return view('posts.show', [
            'post' => $targetPost,
            // 'pageTypePostShow' => true,
            'imgClass' => $imgClass,
        ]);
    }
    public function like(Request $request, Post $post)
    {
        $post->likes()->detach($request->user()->id);
        $post->likes()->attach($request->user()->id);

        // $request->user()はRequestクラスのメソッド。
        // リクエストを送ったユーザーが取得できる

        return [
            'id' => $post->id,
            'countLikes' => $post->count_likes,
        ];
    }

    public function unlike(Request $request, Post $post)
    {
        $post->likes()->detach($request->user()->id);

        return [
            'id' => $post->id,
            'countLikes' => $post->count_likes,
        ];
    }
}
