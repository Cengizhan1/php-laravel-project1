<?php

namespace App\Http\Requests\Balance;

use Illuminate\Foundation\Http\FormRequest;

class RegisterCardRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'alias'=> 'required',
            'cardName'=> 'required',
            'cardNumber'=> 'required',
            'cardMonth'=> 'required',
            'cardYear'=> 'required',

        ];
    }
}
