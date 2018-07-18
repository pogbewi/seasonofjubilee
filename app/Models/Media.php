<?php

namespace Seasonofjubilee\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';

    protected $fillable = [
        'filename', 'type','url',
        'video_thumb','size',
        'status','media_description',
        'url_type','media_title',
        'download_count','last_download_time'
    ];

    public function sermons()
    {
        return $this->morphedByMany('Seasonofjubilee\Models\Sermon','mediable', 'media_mediable','mediable_id', 'media_id');
    }

    public function posts()
    {
        return $this->morphedByMany('Seasonofjubilee\Models\Post', 'media_mediable');
    }

    public static function boot(){
        parent::boot();
        Media::deleting(function($media){
            $media->sermons()->sync([]);
            $media->posts()->sync([]);
        });
    }
}
