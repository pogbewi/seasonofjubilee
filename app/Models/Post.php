<?php

namespace Seasonofjubilee\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Cviebrock\EloquentSluggable\Sluggable;
use Intervention\Image\ImageManagerStatic as Image;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Cviebrock\EloquentTaggable\Taggable;
class Post extends Model
{
    use Sluggable, SluggableScopeHelpers, Taggable;

    protected $table = "posts";

    protected $fillable = ['title','allow_comments', 'seo_title','body', 'slug', 'meta_description', 'meta_keywords', 'featured', 'category_id','published_at','views','photo'];

    protected $guarded = [];

    protected $casts = [
        'featured' => 'boolean',
        'allow_comments' => 'boolean',
    ];

    public function save(array $options = [])
    {
        // If no author has been assigned, assign the current user's id as the author of the post
        if (!$this->author_id && Auth::guard('admin')->user()) {
            $this->author_id = Auth::guard('admin')->user()->id;
        }

        parent::save();
    }


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

    public function author()
    {
        return $this->belongsTo('Seasonofjubilee\Models\Admin', 'author_id', 'id');
    }

    /**
     * Scope a query to only published scopes.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished(Builder $query)
    {
        return $query->where('published_at','<', Carbon::now())->orWhere('published_at', Carbon::now());
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category()
    {
        return $this->hasOne('Seasonofjubilee\Models\Category', 'id', 'category_id');
    }

    public function getPublishedAttribute($value){
        if($this->published_at <= Carbon::now()){
            return 'Published';
        }elseif($this->published_at > Carbon::now()){
            return 'Pending';
        }
        return '';
    }

    public function comments(){
        return $this->morphMany('Seasonofjubilee\Models\Comment', 'commentable');
    }
}
