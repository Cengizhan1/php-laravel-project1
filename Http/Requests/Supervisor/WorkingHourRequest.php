<?php

namespace App\Http\Requests\Supervisor;

use App\Models\WorkingHour;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class WorkingHourRequest extends FormRequest
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
            'day' => ['required','string',
                function ($attribute, $value, $fail) {
                    if (WorkingHour::where('supervisor_id',auth()->user()->id)->where('day',$this->day)->count()) {
                        $fail($this->day.'. gün için veri bulunmaktadır!');
                    }
                },
            ],
            'start_at'=>'required|date',
            'end_at'=>'required|date',
            'launch_hour_start_at'=>'required|date',
            'launch_hour_end_at'=>'required|date',
        ];
    }
}
