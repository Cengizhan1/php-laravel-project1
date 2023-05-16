<?php

namespace App\Http\Requests\Supervisor;

use App\Models\WorkingHour;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class EducationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'start_at' => 'date|required',
            'end_at' => 'date|required',
            'school_name' => 'string|required',
            'department' => 'string|required',
        ];
    }
}
