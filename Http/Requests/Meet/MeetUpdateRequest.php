<?php

namespace App\Http\Requests\Meet;

use Illuminate\Foundation\Http\FormRequest;


class MeetUpdateRequest extends FormRequest
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
            'result_type'=>'required|integer',
            'start_at' => 'required|date',
            'end_at' => 'required|date',
            'price' => 'required|integer',
            'message' => 'nullable|string',
            'canceled_message' => 'nullable|string',
        ];
    }
}
