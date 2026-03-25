<?php

namespace App\Http\Requests\Inquiry;

use Illuminate\Foundation\Http\FormRequest;
use App\Usecases\Inquiry\GetInquiryTask\Dto\GetInquiryTaskRequestDto;

class GetInquiryTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'inquiryTaskId' => ['required', 'uuid']
        ];
    }

    public function toDto(): GetInquiryTaskRequestDto
    {
        return new GetInquiryTaskRequestDto(
            inquiryTaskId:  $this->route('inquiryTaskId')
        );
    }

    public function validationData(): array
    {
        return array_merge($this->all(), [
            'inquiryTaskId' => $this->route('inquiryTaskId'),
        ]);
    }
}
