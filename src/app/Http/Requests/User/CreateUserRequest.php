<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Usecases\User\CreateUser\Dto\CreateUserRequestDto;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = array(
            'email'        => ['required', 'string', 'max:255'],
            'password'     => ['required', 'string', 'max:255'],
            'userName'     => ['required', 'string', 'max:255'],
        );

        return $rules;
    }

    public function toDto(): CreateUserRequestDto
    {
        $validated = $this->validated();

        return new CreateUserRequestDto(
            email: $validated['email'],
            password: $validated['password'],
            userName: $validated['userName']
        );
    }
}
