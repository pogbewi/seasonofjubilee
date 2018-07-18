<?php

namespace Seasonofjubilee\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Cviebrock\EloquentSluggable\Sluggable;
use Intervention\Image\ImageManagerStatic as Image;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Cviebrock\EloquentTaggable\Taggable;
class Staff extends Model
{
    use Sluggable, SluggableScopeHelpers;

    protected $table = 'staffs';

    protected $fillable = ['name', 'slug','bio','position','avatar','social_media_handle','published_at'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getPhotoAttribute(){
        return $this->avatar;
    }
}
