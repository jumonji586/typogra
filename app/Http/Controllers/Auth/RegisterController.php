<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use App\Rules\textMaxWidth;
use Illuminate\Support\Facades\Auth;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

    protected $redirectTo = RouteServiceProvider::HOME;

    protected function redirectTo() {
        return route('posts.index');
     }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string',new textMaxWidth(24), 'unique:users'], 
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'rule-privacy' => ['accepted'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    // ↓元々のcreateメソッド
    // protected function create(array $data)
    // {
    //     return User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //     ]);
    // }
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        // idに9999を掛けてから16進数に変換
        $user->display_id = "u-".dechex($user->id * 9999);
        $user->prof_image_path ="/img/prof-image-default/".mt_rand(1, 20).".jpg";
        $user->save();
        return $user;
    }



    public function showProviderUserRegistrationForm(Request $request, string $provider)
    {
        $token = $request->token;

        $providerUser = Socialite::driver($provider)->userFromToken($token);

        return view('auth.social_register', [
            'provider' => $provider,
            'email' => $providerUser->getEmail(),
            'name' => $providerUser->getName(),
            'prof_image_path' => $providerUser->getAvatar(),
            'token' => $token,
        ]);
    }
    public function registerProviderUser(Request $request, string $provider)
    {
        $request->validate([
            'name' => ['required', 'string',new textMaxWidth(24), 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'rule-privacy' => ['accepted'],
            'token' => ['required', 'string'],
        ]);
        
        $token = $request->token;

        $providerUser = Socialite::driver($provider)->userFromToken($token);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'provider_name' => $request->provider,
            'provider_id' =>$providerUser->getId(),
            'prof_image_path' =>$providerUser->getAvatar(),
            'password' => null,
        ]);
         // idに9999を掛けてから16新数に変換
        $user->display_id = "u-".dechex($user->id * 9999);
        $user->save();

        $this->guard()->login($user, true);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }
}
