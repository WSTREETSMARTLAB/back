<?php

namespace App\Http\Requests\Tool;

use App\Http\Requests\BaseFormRequest;

class DeleteAlarmsRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ids' => ['required', 'array'],
        ];
    }
}
