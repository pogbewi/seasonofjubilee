<?php

namespace Seasonofjubilee\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Intervention\Image\ImageManagerStatic as Image;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Cviebrock\EloquentTaggable\Taggable;
class GalleryCategory extends Model
{
    use Sluggable, SluggableScopeHelpers, Taggable;

    protected $table = 'gallery_category';

    protected $fillable = ['slug', 'name', 'order', 'parent_id'];

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
}
