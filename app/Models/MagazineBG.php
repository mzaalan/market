<?php

namespace MetroMarket\MobilePanel\Models;

class MagazineBG extends Post
{

    protected $appends = ['url'];
    protected $hidden  = ['deleted_at', 'created_at', 'value', 'is_active', 'parent_id', 'type', 'end_date', 'title'];

    public function getUrlAttribute()
    {
        $data = json_decode($this->value);
        return asset('/upload/' . data_get($data, 'image_name'));
    }
}
