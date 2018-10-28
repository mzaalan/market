<?php

namespace MetroMarket\MobilePanel\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use MetroMarket\MobilePanel\Repositories\Image\ImageRepository;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(){
        $user = null;
        if(auth()->check()){
            $user = auth()->user();
        }
        view()->share('user',$user);
    }

    protected function upload_file($properties) {
        $uploadFile = new ImageRepository(
                $properties, null);
        $result = $uploadFile->post(false);
        $file = $result[$uploadFile->get_param_name()][0];
        if (isset($file->error)) {
            return array(
                'success' => false,
                'err_msg' => $file->error
            );
        } else {
            return array(
                'success' => true,
                'name' => $file->name
            );
        }
    }
}
