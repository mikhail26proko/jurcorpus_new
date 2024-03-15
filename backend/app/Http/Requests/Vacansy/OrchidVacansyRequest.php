<?php

namespace App\Http\Requests\Vacansy;

use Illuminate\Foundation\Http\FormRequest;

class OrchidVacansyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'         => 'sometimes|integer|exists:vacansies,id|nullable',
            'title'      => 'required|string',
            'description'=> 'required|string',
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
