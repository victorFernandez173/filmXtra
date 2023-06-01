<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\RedirectResponse;

class SocialAuthController extends Controller
{
    /**
     * Redirect the user to the Google authentication page
     * 
     */
    public function redirectToProvider(): RedirectResponse
    {
        session()->regenerate();
        return Socialite::driver('google')->redirect();
    }

    public function handleCallback(): RedirectResponse
    {
        try{
            $user = Socialite::driver('google')->user();
        } catch(\Exception $e) {
            return redirect('/login');
        }

        $userExist = User::where('google_id', $user->id)->first();

        if ($userExist !== null) {
            Auth::login($userExist);
        }else{
            $newUser = User::create([
                'email' => $user->email,
                'google_id' => $user->id,
                'password' => $user->id,
                'email_verified_at' => Date::now()
            ]);
            Auth::login($newUser);
        }

        return redirect('/');

    }

    /*public function callback($provider)
    {
        try {
            $SocialUser = Socialite::driver($provider)->user();
           if(User::where('email', $SocialUser->getEmail())->exists()){
               return redirect('/login')->withErrors(['email' => 'This email uses different method to login.']);
           }
           
           $user = User::where([
               'provider' => $provider,
               'provider_id' => $SocialUser->id
           ])->first();
           if (!$user){
               $password = Str::random(12);
               $user = User::create([
                   'name' => $SocialUser->getName(),
                   'email' => $SocialUser->getEmail(),
                   'username' => User::generateUserName($SocialUser->getNickname()),
                   'password' => $password,
                   'provider' => $provider,
                   'provider_id' => $SocialUser->getId(),
                   'provider_token' => $SocialUser->token,
               ]);

               $user->sendEmailVerificationNotification();

               $user->update([
                   'password' => bcrypt($password)
               ]);
           }
            Auth::login($user);
            
            return redirect('/');
        } catch (\Exception $e){
            return redirect('/login');
        }
    }*/
}
