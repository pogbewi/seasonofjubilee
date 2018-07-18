<?php

namespace Seasonofjubilee\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Intervention\Image\ImageManagerStatic as Image;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Cviebrock\EloquentTaggable\Taggable;
use Carbon\Carbon;
class Sermon extends Model
{
    use Sluggable, SluggableScopeHelpers, Taggable;

    protected $table = 'sermons';

    protected $fillable = [
        'title', 'preacher','service_id',
        'sermon_category_id','preached_on',
        'status','slug','views','allow_comments',
        'published','free', 'excerpt','scheduled_on',
        'body','meta_description','meta_keywords'
    ];

    protected $casts = [
        'allow_comments' => 'boolean',
        'free' => 'boolean',
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
        return $this->belongsTo('Seasonofjubilee\Models\SermonCategory', 'sermon_category_id','id');
    }

    public function service()
    {
        return $this->belongsTo('Seasonofjubilee\Models\Service');
    }

    public function media()
    {
        return $this->morphToMany('Seasonofjubilee\Models\Media', 'mediable', 'media_mediable', 'mediable_id', 'media_id');
    }

    public function comments(){
        return $this->morphMany('Seasonofjubilee\Models\Comment', 'commentable');
    }

    public function getPublishedAttribute($value){
        if($this->scheduled_on <= Carbon::now()){
            return 'Published';
        }elseif($this->scheduled_on > Carbon::now()){
            return 'Pending';
        }
        return 'Drated';
    }
}
