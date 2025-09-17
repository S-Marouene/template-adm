<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Permissions
        $permissions = [
            // User Management
            ['name' => 'users.read', 'display_name' => 'View Users', 'description' => 'Can view users list and details', 'group' => 'users'],
            ['name' => 'users.write', 'display_name' => 'Create Users', 'description' => 'Can create new users', 'group' => 'users'],
            ['name' => 'users.update', 'display_name' => 'Update Users', 'description' => 'Can edit user information', 'group' => 'users'],
            ['name' => 'users.delete', 'display_name' => 'Delete Users', 'description' => 'Can delete users', 'group' => 'users'],
            
            // Role Management
            ['name' => 'roles.read', 'display_name' => 'View Roles', 'description' => 'Can view roles list and details', 'group' => 'roles'],
            ['name' => 'roles.write', 'display_name' => 'Create Roles', 'description' => 'Can create new roles', 'group' => 'roles'],
            ['name' => 'roles.update', 'display_name' => 'Update Roles', 'description' => 'Can edit role information', 'group' => 'roles'],
            ['name' => 'roles.delete', 'display_name' => 'Delete Roles', 'description' => 'Can delete roles', 'group' => 'roles'],
            
            // Permission Management
            ['name' => 'permissions.read', 'display_name' => 'View Permissions', 'description' => 'Can view permissions list', 'group' => 'permissions'],
            ['name' => 'permissions.write', 'display_name' => 'Create Permissions', 'description' => 'Can create new permissions', 'group' => 'permissions'],
            ['name' => 'permissions.update', 'display_name' => 'Update Permissions', 'description' => 'Can edit permissions', 'group' => 'permissions'],
            ['name' => 'permissions.delete', 'display_name' => 'Delete Permissions', 'description' => 'Can delete permissions', 'group' => 'permissions'],
            
            // Dashboard
            ['name' => 'dashboard.read', 'display_name' => 'View Dashboard', 'description' => 'Can access dashboard', 'group' => 'dashboard'],
            
            // Settings
            ['name' => 'settings.read', 'display_name' => 'View Settings', 'description' => 'Can view settings', 'group' => 'settings'],
            ['name' => 'settings.update', 'display_name' => 'Update Settings', 'description' => 'Can update settings', 'group' => 'settings'],
        ];
        
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission['name']], 
                $permission
            );
        }
        
        // Create Roles
        $roles = [
            [
                'name' => 'super-admin',
                'display_name' => 'Super Administrator',
                'description' => 'Has complete access to all features and settings',
                'permissions' => Permission::all()->pluck('name')->toArray()
            ],
            [
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'Has access to most features except system settings',
                'permissions' => [
                    'dashboard.read', 'users.read', 'users.write', 'users.update', 'users.delete',
                    'roles.read', 'roles.write', 'roles.update', 'settings.read'
                ]
            ],
            [
                'name' => 'user',
                'display_name' => 'User',
                'description' => 'Standard user with basic access',
                'permissions' => ['dashboard.read', 'settings.read']
            ],
            [
                'name' => 'visitor',
                'display_name' => 'Visitor',
                'description' => 'Limited access for visitors',
                'permissions' => ['dashboard.read']
            ]
        ];
        
        foreach ($roles as $roleData) {
            $permissions = $roleData['permissions'];
            unset($roleData['permissions']);
            
            $role = Role::firstOrCreate(
                ['name' => $roleData['name']], 
                $roleData
            );
            
            // Assign permissions to role
            $permissionIds = Permission::whereIn('name', $permissions)->pluck('id');
            $role->permissions()->sync($permissionIds);
        }
    }
}
