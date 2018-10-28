<?php

namespace MetroMarket\MobilePanel\Http\Requests;

use MetroMarket\MobilePanel\Http\Requests\Request;
use MetroMarket\MobilePanel\Models\Post as Post;
use Illuminate\Contracts\Validation\Validator;
use MetroMarket\MobilePanel\Exceptions\InvalidParametersException;

class verifyPostRequest extends Request
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
        //dd(json_encode(Post::TYPES));
        /*if (!$this->has('type') || !in_array($this->has('type'), Post::$type)){
            throw new InvalidParametersException('خطأ في البيانات المدخلة');
        }*/
        return [
            //'type' => 'required'
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
