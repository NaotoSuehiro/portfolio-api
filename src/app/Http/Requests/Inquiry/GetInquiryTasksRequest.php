<?php

namespace App\Http\Requests\Inquiry;

use Illuminate\Foundation\Http\FormRequest;
use App\Usecases\Inquiry\GetInquiryTasks\Dto\GetInquiryTasksRequestDto;

class GetInquiryTasksRequest extends FormRequest
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
            'title' => ['nullable', 'string', 'max:255'],
            'content' => ['nullable', 'text', 'max:10000'],
            'status' => ['nullable', 'string', 'max:255'],
            'createdStartDate' => ['nullable', 'date'],
            'createdEndDate' => ['nullable', 'date'],
            'limit' => ['nullable', 'integer', 'min:1', 'max:100'],
            'page' => ['nullable', 'integer', 'min:1']
        ];
    }

    public function toDto(): GetInquiryTasksRequestDto
    {
        $validated = $this->validated();
        return  new GetInquiryTasksRequestDto(
            title: $validated['title'] ?? null,
            content: $validated['content'] ?? null,
            status: $validated['status'] ?? null,
            createdStartDate: $validated['createdStartDate'] ?? null,
            createdEndDate: $validated['createdEndDate'] ?? null,
            limit: (int)($validated['limit'] ?? 50),
            page: (int)($validated['page'] ?? 1)
        );
    }
}
