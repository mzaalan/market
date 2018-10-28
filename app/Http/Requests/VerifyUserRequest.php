<?php

namespace MetroMarket\MobilePanel\Http\Requests;

use MetroMarket\MobilePanel\Http\Requests\Request;

class VerifyUserRequest extends Request
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
        $main_rules [
            'username'         => 'required|min:3',            
            'name'             => 'required|min:3',
        ];
        if ($this->isMethod('post')) {
            return $main_rules + [
                'password'         => 'required|min:6',
                'repassword'       => 'same:password|min:6'
                ];
        }
        return $main_rules;
    }
}
