<?php

namespace MetroMarket\MobilePanel\Models;

use Illuminate\Database\Eloquent\Model;

class MagazinePhotoModel extends Post
{

    protected $appends = ['image_url'];
    protected $hidden = ['deleted_at','created_at','value','is_active','parent_id','type','end_date','start_date'];

    public function getImageUrlAttribute()
    {
        $data =  json_decode($this->value);
        return asset('/upload/magazine/'.data_get($data,'image_name'));
    }
}
