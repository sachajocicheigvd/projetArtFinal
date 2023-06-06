<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SurveyRequest extends FormRequest
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
            // le champ duration doit être de minimum 1 minute
            'duration' => ['required', 'integer', 'min:1'],
            'title' => ['required', 'string', 'max:255'],
            'answers' => ['required', 'array'],
            'answers.*' => ['required', 'string', 'max:255'],
            'artists' => ['array'],
            'artists.*' => ['string', 'max:255'],
            'files' => ['array'],
            'files.*' => ['image', 'max:20480'],
        ];
    }
}
