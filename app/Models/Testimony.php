<?php

namespace Seasonofjubilee\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Cviebrock\EloquentTaggable\Taggable;
class Testimony extends Model
{
    use Sluggable, SluggableScopeHelpers, Taggable;
    protected $table = 'testimonies';

    protected $fillable = [
        'slug', 'name','subject',
        'body','published_at',
        'meta_description',
        'meta_keywords','views',
        'photo',
        'allow_comments'
    ];

    protected $casts = [
        'allow_comments' => 'boolean',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'subject',
            ],
        ];
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function comments(){
        return $this->morphMany('Seasonofjubilee\Models\Comment', 'commentable');
    }
}
