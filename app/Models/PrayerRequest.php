<?php

namespace Seasonofjubilee\Models;

use Illuminate\Database\Eloquent\Model;

class PrayerRequest extends Model
{
    protected $table = "prayer_request";

    protected $fillable = ['name', 'phone','email', 'subject', 'message', 'read'];

    protected $guarded = [];

    protected $casts = [
        'read' => 'boolean',
    ];
}
