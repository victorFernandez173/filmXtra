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
use Illuminate\Support\Facades\Session;
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
        //Redirect::setIntendedUrl(url()->previous());
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
            /*dd($email);*/
        //if($email != null){
            /*$user = new User([$email]);*/
            $user = new User([
                'name' => $email->name,
                'email' => $email->email,
                'password' => $email->password,
                'email_verified_at' => $email->email_verified_at,
                'created_at' => $email->created_at,
                'updated_at' => $email->updated_at,
                'id' => $email->id
            ]);
            /*dd($user->getAttributes());*/
            //->getKey()
            //$_SESSION['user'] = $user;
            /*Session::put('user', $user);*/
            session(['user' => $user]);
            //dd($email->email_verified_at);
            /*dd(session('user')->hasVerifiedEmail());*/
            if(session()->get('user')->hasVerifiedEmail()){
                error_log('TIENE EL MAIL VERIFICADO !');
                Auth::login(session('user'));
                return redirect()->intended(RouteServiceProvider::HOME);
            }
        //}
            //unset($user['email_verified_at']);
            error_log(session()->get('user') . ' PRUEBAS');
            //session()->get('user')->forceDelete('email_verified_at');
            //dd(session()->get('user'));
            error_log('NOOOO TIENE EL MAIL VERIFICADO !');
            /*dd($user->hasVerifiedEmail());*/
            return redirect('verify-email');
        //}
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
