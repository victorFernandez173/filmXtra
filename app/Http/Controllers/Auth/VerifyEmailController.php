<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        /*dd($request);*/
        error_log('AAAAAAAAAAAAAAAAAAAAAAA');
        error_log($request);
        error_log('AAAAAAAAAAAAAAAAAAAAAAA');
        //$request->user()
        /*dd($request);*/
        if (session('user')->hasVerifiedEmail()) {
            /*dd(session('user'));*/
            error_log('EMAIL VERIFICADO VERIFY EMAIL CONTROLLER');
            Auth::login(session('user'));
            return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
        }
        /*dd(session('user'));*/
        if (session('user')->markEmailAsVerified()) {
            error_log('NUEVO VERIFICADO VERIFY EMAIL CONTROLLER');
            event(new Verified(session('user')));
            Auth::login(session('user'));
        }

        error_log('POR AQUÍ VA');

        return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
    }
}
