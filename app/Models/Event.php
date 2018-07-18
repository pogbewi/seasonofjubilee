<?php

namespace Seasonofjubilee\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Intervention\Image\ImageManagerStatic as Image;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Cviebrock\EloquentTaggable\Taggable;
class Event extends Model
{
    use Sluggable, SluggableScopeHelpers, Taggable;

    protected $table = 'events';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'address',
        'start_date',
        'end_date',
        'email',
        'phone',
        'website',
        'registrable',
        'type',
        'filename',
        'size',
        'video_thumb'
    ];

    protected $casts = [
        'registrable' => 'boolean',
    ];

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

    public function getUpComingEventsAttribute($value){
        return $this->where('start_date', '>', Carbon::now() );
    }

    public function getPastEventsAttribute($value){
        return $this->where('start_date', '<', Carbon::now() );
    }

    public function getOnGoingEventsAttribute($value){
        return $this->where('end_date', '>=', Carbon::now())->where('start_date', '<=', Carbon::now());
    }
}
