<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentValidationRequest extends FormRequest
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
            'message' => 'required|string|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'message.required' => 'O campo mensagem é obrigatório',
            'message.string' => 'O campo mensagem deve ser um texto válido',
            'message.max' => 'O campo mensagem deve ter somente 255 caracteres',
        ];
    }
}
