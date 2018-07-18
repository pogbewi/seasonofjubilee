<?php

namespace Seasonofjubilee\Models;

use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    protected $table = 'event_registration';

    protected $fillable = ['name', 'phone','attend','email','seat','gender'];

    protected $casts = [
        'attend' => 'boolean',
    ];
}
