<?php

namespace App\Http\Requests\Inquiry;

use Illuminate\Foundation\Http\FormRequest;
use App\Usecases\Inquiry\CreateInquiryTask\Dto\CreateInquiryTaskRequestDto;

class CreateInquiryTaskRequest extends FormRequest
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
            'title'        => ['required', 'string', 'max:255'],
            'content'      => ['required', 'string'],
            'status'       => ['required', 'string'],
            'userId'       => ['required', 'string', 'uuid'],
        );

        return $rules;
    }

    public function toDto(): CreateInquiryTaskRequestDto
    {
        $validated = $this->validated();

        return new CreateInquiryTaskRequestDto(
            title: $validated['title'],
            content: $validated['content'],
            status: $validated['status'],
            userId: $validated['userId']
        );
    }
}
