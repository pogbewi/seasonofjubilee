<?php

use Illuminate\Database\Seeder;
use Seasonofjubilee\Models\Role;
use Seasonofjubilee\Models\Permission;
class RoleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create($this->roles(), $this->map());
    }


    private function roles()
    {
        $rows = [
            'admin' => [
                'admin-settings-controller'=> 'c,r,u,d',
                'admin-events-controller'=> 'c,r,u,d',
                'admin-admin-controller'=> 'c,r,u,d',
                'admin-sermon-controller'=> 'c,r,u,d',
                'admin-services-controller'=> 'c,r,u,d',
                'admin-testimony-controller'=> 'c,r,u,d',
                'admin-user-controller'=> 'c,r,u,d',
                'admin-media-controller'=> 'c,r,u,d',
                'admin-give-controller'=> 'c,r,u,d',
                'admin-sermon-category-controller'=> 'c,r,u,d',
                'admin-post-category-controller'=> 'c,r,u,d',
                'admin-post-controller'=> 'c,r,u,d',
                'admin-roles-controller'=> 'c,r,u,d',
                'admin-permissions-controller'=> 'c,r,u,d',
                'admin-contact-controller'=> 'r,d',
                'admin-home-controller'=> 'r,d',
                'admin-staff-controller'=> 'c,r,u,d',
                'admin-gallery-controller'=> 'c,r,u,d',
                'admin-gallery-category-controller'=> 'c,r,u,d',
                'admin-prayer-request-controller'=> 'r,d',
                'admin-comment-controller'=> 'r,u,d',
                'admin-project-controller'=> 'c,r,u,d',
            ],
            'manager' => [
                'admin-panel' => 'r',
            ],
            'moderator' => [
                'admin-panel' => 'r',
            ],
        ];

        return $rows;
    }

    private function map()
    {
        $rows = [
            'c' => 'create',
            'r' => 'read',
            'u' => 'update',
            'd' => 'delete'
        ];

        return $rows;
    }

    private function create($roles, $map)
    {
        $mapPermission = collect($map);

        foreach ($roles as $key => $modules) {
            // Create a new role
            $role = Role::create([
                'name' => $key,
                'display_name' => ucwords(str_replace("_", " ", $key)),
                'description' => ucwords(str_replace("_", " ", $key))
            ]);

            $this->command->info('Creating Role ' . strtoupper($key));

            // Reading role permission modules
            foreach ($modules as $module => $value) {
                $permissions = explode(',', $value);

                foreach ($permissions as $p => $perm) {
                    $permissionValue = $mapPermission->get($perm);

                    $moduleName = ucwords(str_replace("-", " ", $module));

                    $permission = Permission::firstOrCreate([
                        'name' => $permissionValue . '-' . $module,
                        'display_name' => ucfirst($permissionValue) . ' ' . $moduleName,
                        'description' => ucfirst($permissionValue) . ' ' . $moduleName,
                    ]);

                    $this->command->info('Creating Permission to ' . $permissionValue . ' for ' . $moduleName);

                    if (!$role->hasPermission($permission->name)) {
                        $role->attachPermission($permission);
                    } else {
                        $this->command->info($key . ': ' . $p . ' ' . $permissionValue . ' already exist');
                    }
                }
            }
        }
    }
}
