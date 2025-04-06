<?php

namespace App\Http\Requests\Tool;

use App\Enums\ToolType;
use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class ShowToolsRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => ['nullable', 'string', Rule::in(ToolType::values())],
        ];
    }
}
