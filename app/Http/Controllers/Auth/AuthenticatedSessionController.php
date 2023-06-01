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
     * Renderiza la vista de logueo
     */
    public function create(): Response
    {
        //Establece como la url objetivo, la url de origen
        Redirect::setIntendedUrl(url()->previous());
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Maneja solicitud de autenticación
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $email = DB::table('users')->where('email', $request->input()['email'])->first();

            $user = new User([
                'name' => $email->name,
                'email' => $email->email,
                'password' => $email->password,
                'email_verified_at' => $email->email_verified_at,
                'created_at' => $email->created_at,
                'updated_at' => $email->updated_at,
                'id' => $email->id
            ]);
            session(['user' => $user]);
            if(session()->get('user')->hasVerifiedEmail()){
                Auth::login(session('user'));
                return redirect()->intended(RouteServiceProvider::HOME);
            }
            return redirect('verify-email');
    }

    /**
     * Destruye sesión autenticada.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Redirige a la url objetivo
        return redirect(url()->previous());
    }
}
