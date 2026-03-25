<?php

namespace App\Http\Requests\InquiryComment;

use Illuminate\Foundation\Http\FormRequest;
use App\Usecases\InquiryComment\CreateInquiryComment\Dto\CreateInquiryCommentRequestDto;

class CreateInquiryCommentRequest extends FormRequest
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
        return [
            'inquiryTaskId' => ['required', 'uuid'],
            'userId' => ['required', 'uuid'],
            'comment' => ['required', 'string', 'max:1000'],
        ];
    }

    public function toDto(): CreateInquiryCommentRequestDto
    {
        $validated = $this->validated();
        return new CreateInquiryCommentRequestDto(
            inquiryTaskId: $validated['inquiryTaskId'],
            userId: $validated['userId'],
            comment: $validated['comment'],
        );
    }

    public function validationData(): array
    {
        return array_merge($this->all(), [
            'inquiryTaskId' => $this->route('inquiryTaskId'),
        ]);
    }
}
