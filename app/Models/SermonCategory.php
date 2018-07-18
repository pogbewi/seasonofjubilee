<?php

namespace Seasonofjubilee\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Intervention\Image\ImageManagerStatic as Image;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Cviebrock\EloquentTaggable\Taggable;
class SermonCategory extends Model
{
    use Sluggable, SluggableScopeHelpers, Taggable;

    protected $table = 'sermon_categories';

    protected $fillable = ['slug', 'name','parent_id','order'];

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

    public function sermon()
    {
        return $this->hasMany('Seasonofjubilee\Models\Sermon')
            ->published()
            ->orderBy('created_at', 'DESC');
    }

    public function parent()
    {
        return $this->belongsTo('Seasonofjubilee\Models\SermonCategory', 'parent_id');
    }

    public function children(){
        return $this->hasMany('Seasonofjubilee\Models\SermonCategory', 'parent_id');
    }

    public static function boot() {
        // Reference the parent::boot() class.
        parent::boot();
        Category::deleting(function($category) {
            foreach($category->children as $subcategory){
                $subcategory->delete();
            }
        });
    }
}
