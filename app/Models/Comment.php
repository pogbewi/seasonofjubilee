<?php

namespace Seasonofjubilee\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Comment extends Model
{
    protected $table = "comments";

    protected $fillable = ['name','email', 'approved','body','commentable_id', 'commentable_type'];

    protected $guarded = [];

    protected $casts = [
        'approved' => 'boolean'
    ];

    public function commentable(){
        return $this->morphTo();
    }
}
