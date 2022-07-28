<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function redirectToProvider(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function handleProviderCallback(Request $request, string $provider)
    {
        if($provider === "twitter"){
            // $providerUser = Socialite::driver($provider)->user();
            // $tokenSecret = $providerUser->tokenSecret;
            $providerUser = Socialite::driver($provider)->stateless()->user();
            $tokenSecret = "hoge";
        }else if($provider === "google"){
            $providerUser = Socialite::driver($provider)->stateless()->user();
            $tokenSecret = "hoge";
        }
        // ユーザーテーブルの中からprovider_nameとprovider_idが一致するものが
        // あればログインさせる。なければ登録画面へ。
        $user = User::where('provider_name', $provider)->where('provider_id',$providerUser->getId())->first();
        if ($user) {
            $this->guard()->login($user, true);
            return $this->sendLoginResponse($request);
        }

        return redirect()->route('register.{provider}', [
            'provider' => $provider,
            'token' => $providerUser->token,
            'tokenSecret' => $tokenSecret,
        ]);     

    }
}
