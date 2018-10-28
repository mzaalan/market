<?php

namespace MetroMarket\MobilePanel\Models;

use Illuminate\Database\Eloquent\Model;

class MagazineModel extends Post
{

    protected $appends = ['title', 'cover'];
    
    protected $hidden = ['deleted_at','value','is_active','parent_id','type','end_date','created_at','start_date'];

    public function getTitleAttribute()
    {
        $data =  json_decode($this->value);
        return data_get($data,'title');
    }

    public function images()
    {
        return $this->hasMany(MagazinePhotoModel::class, 'parent_id')->orderBy('order','asc');
    }

    public function getCoverAttribute()
    {
        return data_get($this->images()->first(), 'image_url');
    }

    public function getNotificationMessageAttribute(){
        $data =  json_decode($this->value);
        $message = 'تابعوا جديدنا من خلال استعراض مجلة  :'.$this->title;
        return $message;
    }

}

