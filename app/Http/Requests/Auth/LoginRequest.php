<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado a hacer la petición.
     */
    public function authorize(): bool
    {
        error_log('AUTHORIZE');
        /*dd();*/
        return true;
    }

    /**
     * Reglas.
     *
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        error_log('RULES');
        /*dd();*/
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Mensajes de error
     * @return string[]
     */
    public function messages(): array
    {
        error_log('MESSAGES');
        /*dd();*/
        return [
            'email.email' => 'Formato de email inválido',
            'password.required' => 'Introduzca contraseña',
            'password.string' => 'Formato de contraseña inválido',
        ];
    }

    /**
     * Intento de autenticar las credenciales de la petición.
     *
     * @throws ValidationException
     */
    public function authenticate(): void
    {
        error_log('AUTHENTICATE');
        /*dd();*/
        //$this->ensureIsNotRateLimited();
        /*dd(Auth::attempt($this->only('email', 'password')));*/
        //$2y$10$s2ZrwKVY9z1BIR/n76JbSOVv2BJLB.qAsyYwyzG7F4KcsLH6smlIa
        $user = DB::table('users')->where('email', $this->email)->first();
        /*dd(Hash::check($this->password, $user->password));*/
        if($user != null){
            if(!Hash::check($this->password, $user->password)){
            //if (!Auth::attempt($this->only('email', 'password'), /*$this->inputType, 'password'),*/ $this->boolean('remember'))) {
            /*if (!Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {*/
                RateLimiter::hit($this->throttleKey());

                throw ValidationException::withMessages([
                    'email' => trans('eeeeeeeee'),
                    'password' => trans('contraseña incorrecta')
                ]);
            }
        }else{
            throw ValidationException::withMessages([
                'email' => trans('email incorrecto'),
                'password' => trans('contraseña incorrecta')
            ]);
        }

            RateLimiter::clear($this->throttleKey());
    }

    /**
     * Comprueba si hay límite de intentos..
     *
     * @throws ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        error_log('ENSURE IS NOT RATE LIMITED');
        /*dd();*/
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Devuelve el límite de intentos.
     */
    public function throttleKey(): string
    {
        error_log('THROTTLEKEY');
        /*dd();*/
        return Str::transliterate(Str::lower($this->input('email')) . '|' . $this->ip());
    }
}
