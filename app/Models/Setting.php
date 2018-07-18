<?php

namespace Seasonofjubilee\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'key', 'display_name','details',
        'value','order','type'
    ];

    public function settings($key, $default){
        return $this->where('key', $key);
    }
}
