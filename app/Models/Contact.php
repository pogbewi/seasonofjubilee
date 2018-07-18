<?php

namespace Seasonofjubilee\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contact';

    protected $fillable = ['name', 'phone','read','phone','email','subject','message'];

    protected $casts = [
        'read' => 'boolean',
    ];
}
