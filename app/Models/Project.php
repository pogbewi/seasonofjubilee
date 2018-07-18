<?php

namespace Seasonofjubilee\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Intervention\Image\ImageManagerStatic as Image;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Cviebrock\EloquentTaggable\Taggable;
use Carbon\Carbon;
class Project extends Model
{
    use Sluggable, SluggableScopeHelpers, Taggable;

    protected $table = "projects";

    protected $fillable = ['title', 'slug','description','meta_keywords', 'photo', 'completion_date','published_at'];

    protected $guarded = [];


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

    public function getPublishedAttribute($value){
        if($this->scheduled_on <= Carbon::now()){
            return 'Published';
        }elseif($this->scheduled_on > Carbon::now()){
            return 'Pending';
        }
        return 'Drated';
    }

}
