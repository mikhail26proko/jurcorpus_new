<?php

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;

class OrchidServiceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'         => 'sometimes|integer|exists:services,id|nullable',
            'title'      => 'required|string',
            'content'    => 'required|string',
            'sort'       => 'sometimes|integer|nullable',
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
