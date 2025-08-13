<?php

namespace App\Http\Requests\Tool;

use App\Domain\Tool\Enums\ToolType;
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
            'type' => ['required', 'string', Rule::in(ToolType::values())],
            'name' => ['required', 'string', 'min:3', 'max:24', Rule::unique('tools')->where(function ($query) {
                return $query->where('user_id', auth()->id());
            })],
        ];
    }
}
