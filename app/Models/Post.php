<?php

namespace MetroMarket\MobilePanel\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    const PER_PAGE = 8;

    protected $table    = 'posts';
    protected $fillable = [
        'type', 'value', 'is_active', 'end_date', 'parent_id', 'start_date',
    ];
    protected $hidden = ['deleted_at', 'created_at', 'value'];

    /*public static $type = ['Offer', 'SlidePhoto','Magazine','MagazinePhoto','PointsMagazine','Notification','MemberMessage'];

    public static $image_path = [
    'PointsMagazine' =>  'points/',
    'SlidePhoto'     =>  'slides/',
    'Offer'          =>  'offers/'
    ];  */

    public function children()
    {
        return $this->hasMany(Post::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Post::class, 'parent_id');
    }

    public function getDataAttribute()
    {
        return json_decode($this->value);
    }

    public function scopeKey(Builder $query, $key)
    {
        return $query->where('type', $key);
    }

    public function scopeValid(Builder $query)
    {
        return $query->where(function ($query) {
            $query->where('end_date', '>=', Carbon::now())
                ->orWhereNull('end_date');
        })
            ->where('is_active', '!=', 0);
    }

    public function scopeNotValid(Builder $query)
    {
        return $query->where('end_date', '<', Carbon::now())->orWhere('is_active', 0)->orWhereNotNull('deleted_at');
    }

    public static function getImageBasePath($type)
    {
        switch ($type) {
            case 'Offer':return 'offers';
                break;
            case 'SlidePhoto':return 'slides';
                break;
            case 'Magazine':return 'magazine';
                break;
            case 'MagazinePhoto':return 'magazine';
                break;
            case 'PointsMagazine':return 'points';
                break;
            default:return '';
        }
    }
}
