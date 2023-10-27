<?php

namespace App\Http\Requests\Api\V1\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['nullable', 'string', 'min:2', 'max:64'],
            'email' => ['nullable', 'email', 'min:2', 'max:64'],
            'phone' => ['nullable', 'string', 'min:2', 'max:64'],
            'city' => ['nullable', 'string', 'min:2', 'max:64'],
        ];
    }
}
