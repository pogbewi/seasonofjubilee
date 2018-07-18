<?php

namespace Seasonofjubilee\Models;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;
use Illuminate\Support\Facades\Config;
class Role extends EntrustRole
{
    protected $fillable = ['name', 'display_name', 'description'];

    public function users()
    {
        return $this->hasMany('Seasonofjubilee\Models\User');
    }


    public function permissions()
    {
        return $this->belongsToMany('Seasonofjubilee\Models\Permission');
    }

    public function admins()
    {
        return $this->belongsToMany(Config::get('auth.providers.admins.model'), Config::get('entrust.role_admin_table'),Config::get('entrust.role_foreign_key'),Config::get('entrust.admin_foreign_key'));
        // return $this->belongsToMany(Config::get('auth.model'), Config::get('entrust.role_user_table'));
    }
}
