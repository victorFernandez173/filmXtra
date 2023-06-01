<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Redirect;

class RegisteredUserController extends Controller
{
    /**
     * Muestra la vista de registro
     */
    public function create(): Response
    {
        Redirect::setIntendedUrl(url()->previous());

        return Inertia::render('Auth/Register');
    }

    /**
     * Maneja la solicitud de registro.
     *
     * @throws ValidationException
     */
    public function store(RegisterRequest $request): RedirectResponse | Response
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        event(new Registered($user));

        session(['user' => $user]);

        return redirect('verify-email');
    }
}
