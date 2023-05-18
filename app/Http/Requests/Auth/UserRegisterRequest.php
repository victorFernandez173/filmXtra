<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class UserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:25',
            'email' => 'required|string|email|max:60|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }


    /**
     * Mensages de error
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Introduzca nombre',
            'name.max' => 'Nombre: máximo 25 caracteres',
            'email.required' => 'Introduzca email',
            'email.email' => 'Formato de email',
            'email.max' => 'Email: máximo 60 caracteres',
            'email.unique' => 'Email ya existente',
            'password' => 'Introduzca contraseña',
            'password.required' => 'Introduzca contraseña',
            'password.confirmed' => 'Confirme password'
        ];
    }
}
