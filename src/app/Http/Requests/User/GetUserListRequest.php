<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Usecases\User\GetUserList\Dto\GetUserListRequestDto;

class GetUserListRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['nullable', 'string', 'max:255'],
            'userName' => ['nullable', 'string', 'max:255'],
            'limit' => ['nullable', 'integer', 'min:1', 'max:100'],
            'page' => ['nullable', 'integer', 'min:1']
        ];
    }

    public function toDto(): GetUserListRequestDto
    {
        $validated = $this->validated();
        return  new GetUserListRequestDto(
            email: $validated['email'] ?? null,
            userName: $validated['userName'] ?? null,
            limit: (int)($validated['limit'] ?? 50),
            page: (int)($validated['page'] ?? 1)
        );
    }
}
