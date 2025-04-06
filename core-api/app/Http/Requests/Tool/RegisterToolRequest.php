<?php

namespace App\Http\Requests\Tool;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class RegisterToolRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => ['required', 'string'],
            'name' => ['required', 'string', Rule::unique('tools')->where(function ($query) {
                return $query->where('user_id', auth()->id());
            })],
        ];
    }
}
