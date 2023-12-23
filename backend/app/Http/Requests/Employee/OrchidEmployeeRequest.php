<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class OrchidEmployeeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'            => 'sometimes|integer|exists:employees,id|nullable',
            'last_name'     => 'sometimes|string|max:255',
            'first_name'    => 'sometimes|string|max:255',
            'sur_name'      => 'sometimes|string|max:255',
            'email'         => 'sometimes|string|max:255',
            'phone'         => 'sometimes|string|max:25',
            'branch_id'     => 'sometimes|integer|exists:branches,id|nullable',
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
