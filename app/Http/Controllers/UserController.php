<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\textMaxWidth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Image; //intervention/imageライブラリの読み込み
use App\Notifications\InformationNotification;

class UserController extends Controller
{
    public function Myshow(string $display_id)
    {
        $user = User::where('display_id', $display_id)->first();
        if(!$user){
            return redirect('/')->with('message', '該当のユーザーは存在しません');
        }
        $userPosts = $user->posts()->orderByDesc('created_at')->get();
        return view('users.show', [
            'user' => $user,
            'userPosts' => $userPosts,
            // 'pageTypeUserShow' => true,
        ]);
    }
    public function Myedit()
    {
        // $user = User::where('display_id', $display_id)->first();
        // if (Auth::guard()->user()->name != $user->name) {
        //     return redirect('/')->with('message', '編集できるのは本人のみです');
        // }
        $user = Auth::user();

        return view('users.edit', [
            'user' => $user,
        ]);
    }
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required','string',
             new textMaxWidth(24),
            //  オリジナルで作った文字数制限ルール
             Rule::unique('users')->ignore(Auth::id())],
            // ユニーク制限から自身の値を除外するためにignoreしてる
            'email' => ['string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::id())],
            'prof_text' => ['nullable','string', new textMaxWidth(120),],
            'prof_image' => 'file|image|mimes:jpg,png,gif,jpeg',
            'cropX' => ['nullable','integer'],
            'cropY' => ['nullable','integer'],
            'cropW' => ['nullable','integer'],
            'cropH' => ['nullable','integer'],
        ]);
        
        if ($request->file("prof_image")) {
            $thistime = date("YmdHis");
            $save_image_path="storage/uploads/prof_image/".$user->id.$thistime.".jpg";
            Image::make($request->file('prof_image'))->crop($request->cropW,$request->cropH,$request->cropX,$request->cropY)->resize(200,200)->save($save_image_path,70);
            $user->prof_image_path = "/".$save_image_path;
        }
        $user->fill([
            'name' => $request->name,
            'email' => $request->email,
            'prof_text' => $request->prof_text,
        ])->save();

        return redirect()->route('users.show', ['display_id' => $user->display_id]);
    }
    public function follow(Request $request, User $user)
    {

        if ($user->id === $request->user()->id) {
            return abort('404', 'Cannot follow yourself.');
        }
        else{
            $user->notify(new InformationNotification(null,$request->user(),"follow" ,null));
        }

        $request->user()->followings()->detach($user);
        $request->user()->followings()->attach($user);

        return ['name' => $user->name];
    }
    public function unfollow(Request $request, User $user)
    {
        if ($user->id === $request->user()->id) {
            return abort('404', 'Cannot follow yourself.');
        }
        $request->user()->followings()->detach($user);

        return ['name' => $user->name];
    }
    public function followings(string $display_id)
    {
        $user = User::where('display_id', $display_id)->first();

        $followings = $user->followings()->with('followers')->orderByDesc('created_at')->paginate(30);
        // このfollowingsはユーザーモデルに定義されているリレーションメソッド
        // 下のfollowersとかも同様

        return view('users.follow-list', [
            'user' => $user,
            'followList' => $followings,
            'followPageFlag' => 'followings',
        ]);
    }

    public function followers(string $display_id)
    {
        $user = User::where('display_id', $display_id)->first();
        $followers = $user->followers()->with('followers')->orderByDesc('created_at')->paginate(30);
        return view('users.follow-list', [
            'user' => $user,
            'followList' => $followers,
            'followPageFlag' => 'followers',
        ]);
    }
    public function leave(string $display_id)
    {
        $user = User::where('display_id', $display_id)->first();
        $this->authorize('leave', $user);
        return view('users.leave', [
            'user' => $user,
        ]);
    }
    public function destroy(User $user,Request $request)
    {
        $request->validate([
            'delete_accept' => ['accepted'],
        ]);
        $user->delete();
        return redirect('/')->with('message', 'アカウントを削除しました');
    }
    public function info()
    {
        $user = Auth::user();
        $infolist = $user->notifications()->paginate(30);
        // ↑通知テーブルに入ってる情報を取得
        $user->unreadNotifications->markAsRead();
        // ↑取得した後に既読にする
        return view('users.info', [
            'user' => $user,
            'infolist' => $infolist,
        ]);
    }
}
