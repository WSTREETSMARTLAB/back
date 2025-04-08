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
            'light_day_threshold' => ['nullable', 'integer', 'between:0,100'],
            'light_night_threshold' => ['nullable', 'integer', 'between:0,100'],
            'day_start' => ['nullable', 'date_format:H:i'],
            'day_end' => ['nullable', 'date_format:H:i'],
        ];
    }
}
