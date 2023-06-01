<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class NewPasswordController extends Controller
{
    /**
     * Muesra la vista de reseteo de password
     */
    public function create(Request $request): Response
    {
        return Inertia::render('Auth/ResetPassword', [
            'email' => $request->email,
            'token' => $request->route('token'),
        ]);
    }

    /**
     * Maneja la petición de nuevo password.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'token' => 'required',
                'email' => 'required|email',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ],
            [
                'token.required' => 'No tiene token, imposible proceder', 'email.required' => 'Inserte email', 'email.email' => 'Formato de email incorrecto', 'password.required' => 'Inserte password', 'password.confirmed' => 'Confirmacion de password fallida', 'password.min' => 'Al menos 8 caracteres para su password'
            ]);

        // Para resetear el password del usario. Si hay éxito, se modificará
        // el password de un usuario de forma persistente también en la bbdd.
        // Sino, se devolverá el error.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request['password']),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // Si el password ha sido reseteado con éxito, redirigimos
        // a la pagina de de bienvenida. Si ha habido errores
        // se rediriga a donde estuvieran antes.
        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', __($status));
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }
}
