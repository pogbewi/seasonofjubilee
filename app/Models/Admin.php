<?php

namespace Seasonofjubilee\Models;

use Seasonofjubilee\Notifications\AdminResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Cache\TaggableStore;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
class Admin extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'avatar', 'password','phone','gender'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function roles()
    {
        return $this->belongsToMany(Config::get('entrust.role'), Config::get('entrust.role_admin_table'), Config::get('entrust.admin_foreign_key'), Config::get('entrust.role_foreign_key'));
    }


    public function hasRole($name)
    {
        foreach($this->roles as $role)
        {
            if($role->name == $name) return true;
        }
        return false;
    }

    public function setRole($id)
    {
        $role = DB::table('roles')->find($id);
        if($role){
            $this->roles()->sync($role->id);
            $this->save();
        }
        return $this;
    }

    public function cachedRoles()
    {
        $userPrimaryKey = $this->primaryKey;
        $cacheKey = 'entrust_roles_for_admin_'.$this->$userPrimaryKey;
        if(Cache::getStore() instanceof TaggableStore) {
            return Cache::tags(Config::get('entrust.role_admin_table'))->remember($cacheKey, Config::get('cache.ttl'), function () {
                return $this->roles()->get();
            });
        }
        else return $this->roles()->get();
    }
    public function save(array $options = [])
    {   //both inserts and updates
        // If no avatar has been set, set it to the default
        if(Cache::getStore() instanceof TaggableStore) {
            Cache::tags(Config::get('entrust.role_admin_table'))->flush();
        }
        return parent::save($options);
    }
    public function delete(array $options = [])
    {   //soft or hard
        parent::delete($options);
        if(Cache::getStore() instanceof TaggableStore) {
            Cache::tags(Config::get('entrust.role_admin_table'))->flush();
        }
    }

    public function restore()
    {   //soft delete undo's
        parent::restore();
        if(Cache::getStore() instanceof TaggableStore) {
            Cache::tags(Config::get('entrust.role_admin_table'))->flush();
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPassword($token));
    }

    public function getPhotoAttribute($options){
        if($this->avatar != ''){
            return asset('/storage/uploads/admin/photos/'.$this->avatar);
        }
        return '/storage/admin/image/avatar/'.$this->gender.'_avatar.png';
    }
}
