<?php

namespace MetroMarket\MobilePanel\Http\Requests;

use MetroMarket\MobilePanel\Http\Requests\Request;
use MetroMarket\MobilePanel\Http\Requests\verifyPostRequest;
use MetroMarket\MobilePanel\Exceptions\InvalidParametersException;
use Illuminate\Contracts\Validation\Validator;

class verifyNotificationRequest extends verifyPostRequest
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
        return parent::rules() + [
            'message' => 'required|min:5|max:500',
        ];
    }

    public function attributes(){
        return  [
            'message' => 'نص الاشعار',   
        ];
    }

}
