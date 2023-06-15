<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
             // Validation des données du formulaire
            'last_name' => ['required', 'string', 'min:2', 'max:255'],
            'first_name' => ['required', 'string', 'min:2', 'max:255'],
            // Le champ email et username doivent être unique dans la table users
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'min:2', 'max:255', 'unique:users'],
            // Rules\Password::defaults() permet de valider le mot de passe avec les règles par défaut de Laravel (min 8 caractères)
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }
}
