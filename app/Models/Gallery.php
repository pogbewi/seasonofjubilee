<?php

namespace Seasonofjubilee\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManagerStatic as Image;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Cviebrock\EloquentTaggable\Taggable;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
class Gallery extends Model
{
    use Sluggable, SluggableScopeHelpers, Taggable;

    protected $table = 'galleries';

    protected $fillable = [
        'title', 'filename', 'type','url',
        'video_thumb','size',
        'status','description',
        'download_count','last_download_time',
        'published_at','slug','views','gallery_type',
        'allow_comments','gallery_category_id','audio_thumb',
        'featured','embed_id'
    ];

    protected $casts = [
        'featured' => 'boolean'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category()
    {
        return $this->hasOne('Seasonofjubilee\Models\GalleryCategory', 'id', 'gallery_category_id');
    }

    public function getPublishedAttribute($value){
        if($this->published_at <= Carbon::now()){
            return 'Published';
        }elseif($this->published_at > Carbon::now()){
            return 'Pending';
        }
        return '';
    }

}
