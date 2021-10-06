<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class SocialiteController extends Controller
{
    //
    public function kakaoRedirect()
    {
        return Socialite::driver('kakao')->redirect();
    }

    public function kakaoCallback()
    {
        $kakao_user = Socialite::driver('kakao')->user();

        $findUser = User::where('email',$kakao_user->email)->first();

        if($findUser){
            Auth::login($findUser);
            return redirect('/');
        }else{
            $user = new User;
            $user->name = $kakao_user->nickname;
            $user->email = $kakao_user->email;
            $user->state_id = 1;
            $user->city_id = 1;
            $user->password = Hash::make(rand());
            $user->markEmailAsVerified();
            Auth::login($user);
            return redirect('/');
        }
    }

    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        $google_user = Socialite::driver('google')->user();

        $findUser = User::where('email',$google_user->email)->first();

        if($findUser){
            Auth::login($findUser);
            return redirect('/');
        }else{
            $user = new User;
            $user->name = $google_user->nickname;
            $user->email = $google_user->email;
            $user->state_id = 1;
            $user->city_id = 1;
            $user->password = Hash::make(rand());
            $user->markEmailAsVerified();
            Auth::login($user);
            return redirect('/');
        }
    }
}
