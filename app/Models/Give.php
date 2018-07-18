<?php

namespace Seasonofjubilee\Models;

use Illuminate\Database\Eloquent\Model;

class Give extends Model
{
    protected $table = 'give';

    protected $fillable = ['type', 'amount','name','phone','email'];
}
