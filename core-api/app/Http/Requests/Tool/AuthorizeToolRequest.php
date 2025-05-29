<?php

namespace App\Http\Requests\Tool;

use App\Enums\ToolType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AuthorizeToolRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "type" => ['required', 'string', Rule::in(ToolType::values())],
            "code" => ['required', 'string', 'size:9', 'exists:tools,code']
        ];
    }
}
