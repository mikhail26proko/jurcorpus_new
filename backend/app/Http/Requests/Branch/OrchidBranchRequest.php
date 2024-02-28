<?php

namespace App\Http\Requests\Branch;

use Illuminate\Foundation\Http\FormRequest;

class OrchidBranchRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'         => 'sometimes|integer|exists:branches,id|nullable',
            'title'      => 'required|string',
            'address'    => 'required|string',
            'phone'      => 'sometimes|string|nullable',
            'email'      => 'sometimes|string|nullable',
            'latitude'   => 'sometimes|numeric|nullable',
            'longitude'  => 'sometimes|numeric|nullable',
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
