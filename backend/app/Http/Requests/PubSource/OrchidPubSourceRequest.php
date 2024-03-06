<?php

namespace App\Http\Requests\PubSource;

use Illuminate\Foundation\Http\FormRequest;

class OrchidPubSourceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'         => 'sometimes|integer|exists:pub_sources,id|nullable',
            'title'      => 'required|string|unique:pub_sources',
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
