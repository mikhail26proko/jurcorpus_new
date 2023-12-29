<?php

namespace App\Http\Requests\Lead;

use App\Enums\StatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class OrchidLeadJournalRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'        => 'sometimes|integer|exists:journals,id|nullable',
            'lead_id'   => 'sometimes|integer|exists:leads,id|nullable',
            'message'   => 'sometimes|string',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
