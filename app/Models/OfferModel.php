<?php

namespace MetroMarket\MobilePanel\Models;

class OfferModel extends Post
{
    protected $appends = ['image_url', 'description', 'old_salary', 'new_salary', 'title'];
    protected $hidden = ['deleted_at', 'value', 'is_active', 'parent_id', 'type'];

    public function getImageUrlAttribute()
    {
        $data = json_decode($this->value);

        return asset('/upload/offers/'.data_get($data, 'image_name'));
    }

    public function getDescriptionAttribute()
    {
        $data = json_decode($this->value);

        return data_get($data, 'description');
    }

    public function getOldSalaryAttribute()
    {
        $data = json_decode($this->value);

        return data_get($data, 'old_salary');
    }

    public function getNewSalaryAttribute()
    {
        $data = json_decode($this->value);

        return data_get($data, 'new_salary');
    }

    public function getTitleAttribute()
    {
        $data = json_decode($this->value);

        return data_get($data, 'title');
    }

    public function getNotificationMessageAttribute()
    {
        $data = json_decode($this->value);
        $message = 'عرض جديد :'.$this->title.' بــ '.$this->new_salary.' شيكل';
        ($this->old_salary and $this->old_salary != '') ? $message .= ' بدلا من '.$this->old_salary : '';

        return $message;
    }
}
