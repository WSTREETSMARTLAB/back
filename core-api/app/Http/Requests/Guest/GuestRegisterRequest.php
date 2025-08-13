<?php

namespace App\Http\Requests\Guest;

use App\Http\Requests\BaseFormRequest;

class GuestRegisterRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ip'              => ['required', 'ip'],
            'user_agent'      => ['nullable', 'string', 'max:1024'],
            'accept_language' => ['nullable', 'string', 'max:64'],
            'referer'         => ['nullable', 'url', 'max:2048'],
            'host'            => ['nullable', 'string', 'max:255'],
            'path'            => ['nullable', 'string', 'max:2048'],
            'method'          => ['nullable', 'string', 'max:10', 'in:GET,POST,PUT,PATCH,DELETE,OPTIONS,HEAD'],
            'query'           => ['nullable', 'string', 'max:2048'],
        ];
    }
}
