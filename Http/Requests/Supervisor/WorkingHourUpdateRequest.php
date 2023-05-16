<?php

namespace App\Http\Requests\Supervisor;

use App\Models\WorkingHour;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class WorkingHourUpdateRequest extends FormRequest
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
            'start_at'=>'required|date',
            'end_at'=>'required|date',
            'launch_hour_start_at'=>'required|date',
            'launch_hour_end_at'=>'required|date',
        ];
    }
}
