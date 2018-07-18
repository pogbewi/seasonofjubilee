<?php

namespace Seasonofjubilee\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
    protected $fillable = [
        'name', 'description','slug',
    ];

}
