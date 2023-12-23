<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;
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
            'email'         => 'sometimes|string|max:255',
            'phone'         => 'sometimes|string|max:25',
            'description'   => 'sometimes|string',
            'branch_id'     => 'sometimes|integer|exists:branches,id|nullable',
            'job_titles.*'  => 'sometimes|integer|exists:job_titles,id|nullable',
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
        $this->merge([
            'job_titles' => $this->prepareJobTitles($this->get('job_titles'))
        ]);
    }

    private function prepareJobTitles(array $jobTitles)
    {
        $finished = [];

        foreach ($jobTitles as $item) {
            if (is_numeric($item)){
                $finished[] = $item;
            } else {
                $jobTitle = JobTitle::create(['title'=>$item]);
                $finished[] = $jobTitle->id;
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
