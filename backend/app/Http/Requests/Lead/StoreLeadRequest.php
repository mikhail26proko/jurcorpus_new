<?php

namespace App\Http\Requests\Lead;

use Illuminate\Foundation\Http\FormRequest;

class StoreLeadRequest extends FormRequest
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
            'branch_id' => 'sometimes|integer|exists:branches,id|nullable',
            'fio'       => 'required|string',
            'email'     => 'sometimes|string|max:255',
            'phone'     => 'sometimes|string|max:25',
            'message'   => 'required|string',
        ];
    }
}
