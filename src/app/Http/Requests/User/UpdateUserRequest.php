<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Usecases\User\UpdateUser\Dto\UpdateUserRequestDto;

class UpdateUserRequest extends FormRequest
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
            'id'           => ['string', 'uuid'],
            'email'        => ['required', 'string', 'max:255'],
            'userName'     => ['required', 'string', 'max:255'],
            'password'     => ['required', 'string', 'max:255'],
        );

        return $rules;
    }

    public function toDto(): UpdateUserRequestDto
    {
        $validated = $this->validated();
        return new UpdateUserRequestDto(
            userId: $validated['id'],
            userName: $validated['userName'],
            email: $validated['email'],
            password: $validated['password']
        );
    }

    public function validationData(): array
    {
        return array_merge($this->all(), [
            'id' => $this->route('id'),
        ]);
    }
}
