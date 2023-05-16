<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class UpdateRequest extends FormRequest
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
            'first_name' => 'required|string|min:3|max:255',
            'thumb' => 'nullable',
            'last_name' => 'required|string|min:3|max:255',
            'email' => 'nullable|string|email:rfc,strict|max:255|unique:users,email,'.$this->user('user')->id,
            'bank_name'=>'nullable|string',
            'iban'=>'nullable|string',
            'gender'=>'nullable|integer',
        ];
    }

//
//    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
//    {
//        $response = new JsonResponse([
//            'message' => $validator->errors()->first(),
//        ], 422);
//
//        throw new \Illuminate\Validation\ValidationException($validator, $response);
//    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'first_name' => trans('user.columns.first_name'),
            'last_name' => trans('user.columns.last_name'),
            'email' => trans('user.columns.email'),
        ];
    }
}
