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
            'birthday'      => 'sometimes|date|nullable',
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
        $this->merge([
            'job_titles' => ($this->prepareRelation(JobTitle::class, ($this->get('job_titles') ?? []))),
            'directions' => ($this->prepareRelation(Direction::class, ($this->get('directions') ?? []))),
        ]);
    }

    private function prepareRelation($type, array $items): array
    {
        $finished = [];

        foreach ($items as $item) {
            if (preg_match('/^\+?\d+$/', $item)){
                $finished[] = intval($item);
            } else {
                $row = $type::create(['title'=>$item]);
                $finished[] = intval($row->id);
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
