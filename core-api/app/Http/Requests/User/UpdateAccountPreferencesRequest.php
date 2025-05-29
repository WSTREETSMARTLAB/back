<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;

class UpdateAccountPreferencesRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|string|min:2|max:24',
            'email' => 'required|string|email',
            'avatar' => 'nullable|string'
        ];
    }
}
