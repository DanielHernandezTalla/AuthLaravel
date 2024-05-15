<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */


    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    public function rules(): array
    {
        return [
            'name' => ['required'],
            'idRol' => ['required', 'min:1'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->input('id'), 'id')],
            'password' => ['required', 'max:50', Password::min(8)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised(),],
            'password_confirmation' => ['required', 'min:5', 'max:50', 'same:password']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'idRol.required' => 'El rol es requerido',
            'idRol.min' => 'Seleccione un rol',
            'email.required' => 'El correo es requerido',
            'email.email' => 'Ingrese un correo correcto'
        ];
    }
}
