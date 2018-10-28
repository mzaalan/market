<?php

namespace MetroMarket\MobilePanel\Http\Requests;

use MetroMarket\MobilePanel\Http\Requests\Request;

class MagazineRequestValidation extends verifyPostRequest
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
            'title' => 'required|min:2|max:50',
        ];
    }

    public function attributes(){
        return  [
            'title' => 'عنوان العدد'
        ];
    }
}
