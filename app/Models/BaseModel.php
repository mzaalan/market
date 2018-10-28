<?php

namespace MetroMarket\MobilePanel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at',
    ];

    protected $hidden = [
        'deleted_at',
    ];

}
