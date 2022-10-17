<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Theme;
use App\Http\Requests\PostRequest;
use Faker\Core\Number;
use Illuminate\Http\Request;
use App\Notifications\InformationNotification;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $themes = Theme::orderByRaw('status is null asc')->orderBy("status", "asc")->get()->keyBy('id');
        // statusの値が小さい順、なおかつnullは後ろへ並べる

        $allPosts = array();

        foreach ($themes as $theme){
            $posts = Post::where('theme_id', '=', $theme->id)->withCount('likes')->orderByDesc('likes_count')->orderByDesc('created_at')->get()->take(5);
            $allPosts[$theme->id] = $posts;
          }

        return view('posts.index', [
            'allPosts' => $allPosts,
            'themes' => $themes,
        ]);
    }
    public function theme($theme,?Request $request){

        $subRecommendPosts = null;
        
        if($theme === 'all'){
            $posts = Post::withCount('likes')->orderByDesc('likes_count')->orderByDesc('created_at')->get();
            $firstTitle = '全ての投稿';
        }elseif($theme === 'recommend'){
            $posts = Post::where('status', '=' , 'recommend')->orderByDesc('created_at')->get();
            $firstTitle = 'Recommend';
        }elseif($theme === 'liked'){
            $posts = Auth::user()->likes()->withPivot('created_at')->orderByDesc('pivot_created_at')->get();
            // ↑いいねを押した順番に並べ替え
            $firstTitle = 'イイねした投稿';
            if($posts->count() <= 16){
                $exceptId = $posts->pluck('id');
                $subRecommendPosts = Post::whereNotIn('id', $exceptId)->where('status', '=' , 'recommend')->inRandomOrder()->take(8)->get();
            }
        }elseif($theme === 'followees'){
            $followUserId = Auth::user()->followings->pluck('id');
            $posts = Post::whereIn('user_id', $followUserId)->orderByDesc('created_at')->get();
            $firstTitle = 'フォローユーザーの投稿';
            if($posts->count() <= 16){
                $exceptId = $posts->pluck('id');
                $subRecommendPosts = Post::whereNotIn('id', $exceptId)->where('status', '=' , 'recommend')->inRandomOrder()->take(8)->get();
            }
        }elseif($theme === 'search'){
            $keyword = $request->input('keyword');
            $posts = Post::WhereHas('theme', function ($q) use ($keyword) {
                $q->where('title', 'like', '%' . $keyword . '%');
            })->orderByDesc('created_at')->get();
            $firstTitle = '「'.$keyword.'」の検索結果';
            if($posts->count() <= 16){
                $exceptId = $posts->pluck('id');
                $subRecommendPosts = Post::whereNotIn('id', $exceptId)->where('status', '=' , 'recommend')->inRandomOrder()->take(8)->get();
            }
        }else{
            $posts = Post::where('theme_id', '=' , $theme)->withCount('likes')->orderByDesc('likes_count')->orderByDesc('created_at')->get();
            $themeTitle = Theme::find($theme)->title;
            $firstTitle = '「'.$themeTitle.'」の投稿一覧';
            if($posts->count() <= 16){
                $subRecommendPosts = Post::where('theme_id', '!=' , $theme)->where('status', '=' , 'recommend')->inRandomOrder()->take(8)->get();
            }
        }

        return view('posts.theme', [
            'theme' => $theme,
            'posts' => $posts,
            'subRecommendPosts' => $subRecommendPosts,
            'firstTitle' => $firstTitle,
            'secondTitle' => 'Recommend',
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
            $imgClass = "high-img";
        }else{
            $imgClass = null;
        }
        return view('posts.show', [
            'post' => $targetPost,
            'imgClass' => $imgClass,
        ]);
    }
    public function like(Request $request, Post $post)
    {
        $post->likes()->detach($request->user()->id);
        $post->likes()->attach($request->user()->id);

        // $request->user()はRequestクラスのメソッド。
        // リクエストを送ったユーザーが取得できる

        if ($request->user()->id !== $post->user->id) {

            $post->user->notify(new InformationNotification($post, $request->user(), "like", null));
        }
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
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('posts.index')->with('message', '投稿を削除しました');
    }
    public function recommendOn(Post $post)
    {
        $this->authorize('recommend', $post);
        $post->status = "recommend";
        $post->save();
    }
    public function recommendOff(Post $post)
    {
        $this->authorize('recommend', $post);
        $post->status = null;
        $post->save();
    }
    public function violation(Request $request)
    {
        $targetInfo = isset($request->message)
            ? "違反報告対象URL : " . $request->headers->get("referer") . "\n対象コメント : " . $request->message . "\n"
            : "違反報告対象URL : " . $request->headers->get("referer") . "\n";

        return view('contact.index', [
            'targetInfo' => $targetInfo,
        ]);
    }
}
