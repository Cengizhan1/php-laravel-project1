<?php

namespace App\Http\Requests\Meet;

use Illuminate\Foundation\Http\FormRequest;

class MeetStoreRequest extends FormRequest
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
            'supervisor_id'=>'required|integer',
            'category_id'=>'required|integer',
            'start_at' => 'required|date',
            'end_at' => 'required|date',
            'price' =>[
                'required',
                'integer',
                'min:0',
                function ($attribute, $value, $fail) {
                    if (auth()->user()->wallet->balance < $this->price) {
                        $fail('Yetersiz bakiye!');
                    }
                },
                ],
            'message' => 'nullable|string',
        ];
    }
}
