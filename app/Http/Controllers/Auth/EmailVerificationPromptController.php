<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Monolog\Formatter\SyslogFormatter;

class EmailVerificationPromptController extends Controller
{
    /**
     * Muestra el dialogo de verificación de email
     */
    public function __invoke(Request $request): RedirectResponse|Response
    {
        error_log('ENTRA EN EMAIL PROMPT');
        /*return $request->user()->hasVerifiedEmail()*/
        error_log(session('user'));
        /*dd(session('user'));*/
        /*dd(session('user'));*/
        return session()->get('user')->hasVerifiedEmail()
                    ? redirect()->intended(RouteServiceProvider::HOME)
                    : Inertia::render('Auth/VerifyEmail', ['status' => session('status')]);
    }
}
