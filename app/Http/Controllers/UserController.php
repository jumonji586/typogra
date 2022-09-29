<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

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
}
