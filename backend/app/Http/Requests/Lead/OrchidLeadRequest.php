<?php

namespace App\Http\Requests\Lead;

use App\Enums\StatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class OrchidLeadRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'        => 'sometimes|integer|exists:leads,id|nullable',
            'branch_id' => 'sometimes|integer|exists:branches,id|nullable',
            'fio'       => 'sometimes|string',
            'email'     => 'sometimes|string|max:255',
            'phone'     => 'sometimes|string|max:25',
            'message'   => 'sometimes|string',
            'status'    => [
                'sometimes',
                new Enum(StatusEnum::class),
            ],
            'user_id'   => 'sometimes|integer|exists:users,id|nullable',

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
