<?php

namespace MetroMarket\MobilePanel\Exceptions;

use Exception;
use Illuminate\Http\Request;

class InvalidParametersException extends Exception
{

    public function render(Request $request, Exception $e)
    {
        return response()->json(array(
            'status'       => 'fail',
            'errorMessage' => 'خطأ في المدخلات',
            'errorDetails' => json_decode($e->getMessage()) == '' ? $e->getMessage() : json_decode($e->getMessage()),
        ), 422);
    }
}
