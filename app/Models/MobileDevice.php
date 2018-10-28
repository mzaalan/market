<?php

namespace MetroMarket\MobilePanel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MobileDevice extends Model
{
    use SoftDeletes;

    protected $table = 'mobile_devices';

    protected $fillable = [
        'device_id', 'device_token', 'device_os', 'os_version', 'app_version', 'mobile_no',
    ];

    public function equals(MobileDevice $device)
    {
        if ($this->device_os == $device->device_os) {
            if ($this->device_token == $device->device_token || $this->device_id == $device->device_id) {
                return true;
            }
        }

        return false;
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
