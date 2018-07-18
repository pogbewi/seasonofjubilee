<?php

namespace Seasonofjubilee\Models;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustPermission;
class Permission extends EntrustPermission
{
    public function admins()
    {
        return $this->belongsToMany('Seasonofjubilee\Models\Admin', 'role_admin', 'role_id', 'admin_id');
    }
}
