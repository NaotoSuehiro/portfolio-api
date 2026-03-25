<?php

namespace App\Http\Requests\Inquiry;

use Illuminate\Foundation\Http\FormRequest;
use App\Usecases\Inquiry\UpdateInquiryTaskStatus\Dto\UpdateInquiryTaskStatusRequestDto;
use App\Domain\Inquiry\Enum\InquiryStatusEnum;
use Illuminate\Validation\Rules\Enum;

class UpdateInquiryTaskStatusRequest extends FormRequest
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
            'inquiryTaskId' => ['string', 'uuid'],
            'status'        => ['required',  new Enum(InquiryStatusEnum::class)]
        );

        return $rules;
    }

    public function toDto(): UpdateInquiryTaskStatusRequestDto
    {
        $validated = $this->validated();
        return new UpdateInquiryTaskStatusRequestDto(
            inquiryTaskId: $validated['inquiryTaskId'],
            status: $validated['status']
        );
    }

    public function validationData(): array
    {
        return array_merge($this->all(), [
            'inquiryTaskId' => $this->route('inquiryTaskId'),
        ]);
    }
}
