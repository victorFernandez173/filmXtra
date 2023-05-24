<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:25'],
            'email' => [ 'required', 'email', 'max:60', Rule::unique(User::class)->ignore($this->user()->id)],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nombre requerido',
            'name.max' => 'Máximo 25 caracteres',
            'name.string' => 'Inserte texto para el nombre',
            'email.max' => 'Máximo 60 caracteres',
            'email.required' => 'Inserte email',
            'email.email' => 'Inserte un email válido',
            'email.unique' => 'Ya existe este email'
        ];
    }
}
