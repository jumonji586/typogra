<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\textMaxWidth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Image; //intervention/imageライブラリの読み込み

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
}
