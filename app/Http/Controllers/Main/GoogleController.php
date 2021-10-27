<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\User;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return
     */
    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->stateless()->user();

            $finduser = User::where('google_id', $user->id)->first();

            if($finduser){

                Auth::login($finduser);

                return redirect('/home');

            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => '01999999999',
                    'google_id'=> $user->id,
                    'email_verified_at' => now(),
                    'password' => encrypt($user->email)
                ]);
                $newUser->markEmailAsVerified();
                $newUser->assignRole('seller');

                Auth::login($newUser);

                return redirect('/home');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }



//        $user = Socialite::driver('google')->user();
//        dd($user);
//
//
//        // OAuth 2.0 providers...
//        $token = $user->token;
//        $refreshToken = $user->refreshToken;
//        $expiresIn = $user->expiresIn;
//
//        // OAuth 1.0 providers...
//        $token = $user->token;
//        $tokenSecret = $user->tokenSecret;
//
//        // All providers...
//        $user->getId();
//        $user->getNickname();
//        $user->getName();
//        $user->getEmail();
//        $user->getAvatar();
//        // $user->token
    }

}
