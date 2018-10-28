<?php

namespace MetroMarket\MobilePanel\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationModel extends Post
{

    protected $appends = ['message'];
    protected $hidden = ['deleted_at','value','is_active','parent_id','type','end_date','start_date'];

    public function getMessageAttribute()
    {
        $data =  json_decode($this->value);
        return data_get($data,'message');
    }
}
