<?php

namespace App\Http\Requests\JobTitle;

use Illuminate\Foundation\Http\FormRequest;

class OrchidJobTitleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'         => 'sometimes|integer|exists:job_titles,id|nullable',
            'title'      => 'required|string|unique:job_titles',
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
