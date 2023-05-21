<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): JsonResponse | RedirectResponse | Response
    {
        
        if (session('user')->hasVerifiedEmail()) {
            error_log('ZZZZZZZZZZZZZZZZZZZZZZ');
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        session('user')->sendEmailVerificationNotification();
        response()->json(['status' => 'verification-link-sent']);

        return Inertia::render('Auth/VerifyEmail');
        /*return response()->json(['status' => 'verification-link-sent']);*/
    }
}
