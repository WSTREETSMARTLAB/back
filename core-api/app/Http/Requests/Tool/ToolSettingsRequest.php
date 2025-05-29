<?php

namespace App\Http\Requests\Tool;

use App\Http\Requests\BaseFormRequest;

class ToolSettingsRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'min_temp' => ['nullable', 'numeric', 'between:0,60'],
            'max_temp' => ['nullable', 'numeric', 'between:0,60'],
            'min_hum' => ['nullable', 'integer', 'between:0,100'],
            'max_hum' => ['nullable', 'integer', 'between:0,100'],
            'light_control_enabled' => ['nullable', 'boolean'],
            'timezone' => ['nullable', 'string'],
            'day_start' => ['nullable', 'string'],
            'day_period' => ['nullable', 'numeric', 'between:0,24'],
            'light_day_threshold' => ['nullable', 'integer', 'between:0,100'],
            'light_night_threshold' => ['nullable', 'integer', 'between:0,100'],
        ];
    }
}
