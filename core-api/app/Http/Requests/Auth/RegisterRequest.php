<?php

namespace App\Http\Requests\Auth;

use App\Domain\Company\Models\Company;
use App\Domain\Profile\Enums\ProfileType;
use App\Domain\User\Models\User;
use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => ['required', 'string', Rule::in(ProfileType::values())],
            'email' => ['required', 'string', 'email', Rule::unique('profiles', 'email')
                ->where('owner_type', $this->type)],
            'password' => ['required', 'string', 'max:255'],
        ];
    }

    public function prepareForValidation()
    {
        return $this->merge([
            'type' => $this->input('type') === 'user' ? User::class : Company::class,
        ]);
    }
}
