<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(UserRegisterRequest $request): RedirectResponse | Response
    {
        /*$request->session()->regenerate();*/
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        event(new Registered($user));
        /*$request->session()->keep($user);*/ //NO PONER ESTA LÍNEA

        session(['user' => $user]);
        error_log('99999999999999999999');
        /*dd(session()->all());*/
        error_log('99999999999999999999');
        /*Session::put($user);*/
        /*session('user', $user);*/
        /*Auth::$user();*/
        /*Auth::login($user);*/
        return redirect('verify-email');
    }
}
