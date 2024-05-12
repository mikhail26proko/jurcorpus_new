<?php

namespace App\Http\Requests\Publication;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\PubSource;
use App\Models\PubType;

class OrchidPublicationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'            => 'sometimes|integer|exists:publications,id|nullable',
            'title'         => 'sometimes|string|max:255',
            'sub_title'     => 'sometimes|string|max:255|nullable',
            'publicated_at' => 'sometimes|date',
            'employee_id'   => 'sometimes|integer|exists:employees,id|nullable',
            'pub_source_id' => 'sometimes|integer|exists:pub_sources,id|nullable',
            'pub_type_id'   => 'sometimes|integer|exists:pub_types,id|nullable',
            'link'          => 'sometimes|string|max:500|nullable',
            'photo.*'       => 'sometimes|integer|exists:attachments,id|nullable',
        ];
    }

    /**
     * Подготовить данные для валидации.
     *
     * @return void
     */
    protected function prepareForValidation()
    {

        if (!empty($pub_source = $this->get('pub_source'))) {
            $this->merge([
                'pub_source_id' => $this->prepare(PubSource::class, [$pub_source])[0],
            ]);
        }

        if (!empty($pub_type = $this->get('pub_type'))) {
            $this->merge([
                'pub_type_id' => $this->prepare(PubType::class, [$pub_type])[0],
            ]);
        }

    }

    private function prepare($type, array $items)
    {
        $finished = [];

        foreach ($items as $item) {
            if (is_numeric($item)){
                $finished[] = $item;
            } else {
                $row = $type::create(['title'=>$item]);
                $finished[] = $row->id;
            }
        }

        return $finished;
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
