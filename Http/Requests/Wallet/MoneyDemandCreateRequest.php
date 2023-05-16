<?php

namespace App\Http\Requests\Wallet;

use Illuminate\Foundation\Http\FormRequest;

class MoneyDemandCreateRequest extends FormRequest
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
            'money' => [
                'required',
                'integer',
                'min:0',
                function ($attribute, $value, $fail) {
                    if (auth()->user()->wallet->balance < $this->money) {
                        $fail('Talep ettiğiniz miktar cüzdan bakiyenizden büyük olamaz!');
                    }
                },
                function ($attribute, $value, $fail) {
                    if (!auth()->user()->iban && !auth()->user()->bank_name) {
                        $fail('Banka bilgileri eksik');
                    }
                },
            ],
            'message'=>'nullable|string'
        ];
    }
}
