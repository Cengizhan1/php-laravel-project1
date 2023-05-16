<?php

namespace App\Http\Requests\Supervisor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class WorkingPriceRequest extends FormRequest
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
            'minute' => ['required',
                function ($attribute, $value, $fail) {
                    if ($this->minute % 15 != 0) {
                        $fail('Lütfen 15 ve 15 in katı bir sayı girin!');
                    }
                },],
            'price'=>'required|integer',
        ];
    }
}
