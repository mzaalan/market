<?php

namespace MetroMarket\MobilePanel\Http\Requests;

use MetroMarket\MobilePanel\Http\Requests\Request;

class CreateMobileDeviceRequest extends Request
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
            'device_id'    => 'required|string',
            'device_token' => 'required|string|max:512',
            'device_os'    => 'required|string',
            'os_version'   => 'required|string|max:10',
            'app_version'  => 'required|string|max:10',
        ];
    }
}
