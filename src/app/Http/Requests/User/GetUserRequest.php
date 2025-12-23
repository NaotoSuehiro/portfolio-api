<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Usecases\User\GetUser\Dto\GetUserRequestDto;

class GetUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => ['required', 'uuid']
        ];
    }

    public function toDto(): GetUserRequestDto
    {
        return new GetUserRequestDto(
            userId:  $this->route('id')
        );
    }

    public function validationData(): array
    {
        return array_merge($this->all(), [
            'id' => $this->route('id'),
        ]);
    }
}
