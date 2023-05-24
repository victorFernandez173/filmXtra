<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use Redirect;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        Redirect::setIntendedUrl(url()->previous());
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        error_log('VUUUUUUEEEEELTAAAAAA');
        $request->authenticate();
        /*dd($request);*/
        $request->session()->regenerate();

        /*if($request->user()->hasVerifiedEmail()){
            return redirect()->intended(RouteServiceProvider::HOME);
        }*/
        $email = DB::table('users')->where('email', $request->input()['email'])->first();
        //if($email != null){
            /*dd(session('user'));*/
            //session(['user' => $email]);
            /*dd($request->input()['email']);*/
            
            /*$user = $request->input();
            dd($user);*/
            /*dd($request->input());*/
        if($email != null){
            $user = new User([
                'id' => $email->id,
                'email' => $email->email,
                'password' => Hash::make($email->password)
            ]);

            /*dd($user);*/
            //->getKey()
            
            session(['user' => $user]);
            /*dd($request->input());*/
            if($user->hasVerifiedEmail()){
                error_log('TIENE EL MAIL VERIFICADO !');
                Auth::login(session('user'));
                return redirect()->intended(RouteServiceProvider::HOME);
            }
        //}
            error_log('NOOOO TIENE EL MAIL VERIFICADO !');
            /*dd($user->hasVerifiedEmail());*/
            return redirect('verify-email');
        }
        return redirect('login');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(url()->previous());
    }
}
