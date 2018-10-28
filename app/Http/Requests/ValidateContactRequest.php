<?php

namespace MetroMarket\MobilePanel\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use MetroMarket\MobilePanel\Exceptions\InvalidParametersException;
use MetroMarket\MobilePanel\Http\Requests\Request;

class ValidateContactRequest extends Request
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
            'name'    => 'required|min:3',
            'mobile'  => 'required|digits_between:7,10',
            'message' => 'required|min:5|max:500',
        ];
    }

    public function attributes()
    {
        return [
            'name'    => 'الإسم',
            'mobile'  => 'رقم الجوال',
            'message' => 'نص الرسالة',

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if ($validator->fails()) {
            if ($this->ajax() || $this->wantsJson()) {
                throw new InvalidParametersException($validator->messages());
            } else {
                parent::failedValidation($validator);
            }

        }
    }
}
