<?php

namespace MetroMarket\MobilePanel\Models;

use Illuminate\Database\Eloquent\Model;

class PointsModel extends Post
{

    protected $appends = ['image_url'];
    protected $hidden = ['deleted_at','created_at','value','is_active','parent_id','type','end_date','start_date'];

    public function getImageUrlAttribute()
    {
        $data =  json_decode($this->value);
        return asset('/upload/points/'.data_get($data,'image_name'));
    }

    /*public function getImageBaseAttribute()
    {
        return action('PhotoController@show',[$this->id,400]);
    }*/

    public function getImageBaseAttribute(){
    	$data =  json_decode($this->value);
    	$path = base_path().'/public/upload/points/'.data_get($data,'image_name');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }


}
