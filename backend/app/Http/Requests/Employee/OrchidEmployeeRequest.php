<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Direction;
use App\Models\JobTitle;

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
            'birthday'      => 'sometimes|date',
            'email'         => 'sometimes|string|max:255',
            'phone'         => 'sometimes|string|max:25',
            'description'   => 'sometimes|string',
            'branch_id'     => 'sometimes|integer|exists:branches,id|nullable',
            'job_titles.*'  => 'sometimes|integer|exists:job_titles,id|nullable',
            'directions.*'  => 'sometimes|integer|exists:directions,id|nullable',
            'photo'         => 'sometimes|integer|exists:attachments,id|nullable',
        ];
    }

    /**
     * Подготовить данные для валидации.
     *
     * @return void
     */
    protected function prepareForValidation()
    {

        if (!empty($job_titles = $this->get('job_titles'))) {
            $this->merge([
                'job_titles' => $this->prepare(JobTitle::class, $job_titles),
            ]);
        }

        if (!empty($directions = $this->get('directions'))) {
            $this->merge([
                'directions' => $this->prepare(JobTitle::class, $directions),
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
