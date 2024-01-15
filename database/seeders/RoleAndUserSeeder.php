<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleAndUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'id' => 1,
                'title' => 'Super Admin',

            ]
        ];
        $userList = [
            ['code' => 'AD-0000001', 'first_name' => 'Super Admin', 'username' => 'superadmin@naresh.com', 'email' => 'superadmin@naresh.com', 'password' => Hash::make('password'), 'type' => 1, 'email_verfified' => 1, 'email_verified_at' => now()]
        ];
        $users = User::get()->pluck('email')->toArray();

        foreach ($roles as $role) {
            Role::updateOrCreate(['id' => $role['id']], $role);
            RolePermission::where('role_id', $role['id'])->delete();
            $permissions = Permission::pluck('id')->toarray();
            if ($permissions && is_array($permissions) && !empty($permissions)) {
                foreach ($permissions as $permission) {
                    $data  = RolePermission::create([
                        'role_id' => $role['id'],
                        'permission_id' => $permission
                    ]);
                }
            }
            foreach ($userList as $data) {
                if (!in_array($data['email'], $users)) {
                    $user = User::create($data);
                    UserRole::create([
                        'user_id' => $user->id,
                        'role_id' => $role['id'],
                    ]);
                }
            }
        }
        $roles = [
            [
                'id' => 2,
                'title' => 'Admin',

            ]
        ];
        $userList = [
            ['code' => 'AD-0000002', 'first_name' => 'Admin', 'username' => 'admin@mail.com', 'email' => 'admin@mail.com', 'password' => Hash::make('password'), 'type' => 1, 'email_verfified' => 1, 'email_verified_at' => now()]
        ];
        $users = User::get()->pluck('email')->toArray();

        foreach ($roles as $role) {
            Role::updateOrCreate(['id' => $role['id']], $role);
            RolePermission::where('role_id', $role['id'])->delete();
            $permissions = Permission::pluck('id')->toarray();
            if ($permissions && is_array($permissions) && !empty($permissions)) {
                foreach ($permissions as $permission) {
                    $data  = RolePermission::create([
                        'role_id' => $role['id'],
                        'permission_id' => $permission
                    ]);
                }
            }
            foreach ($userList as $data) {
                if (!in_array($data['email'], $users)) {
                    $user = User::create($data);
                    UserRole::create([
                        'user_id' => $user->id,
                        'role_id' => $role['id'],
                    ]);
                }
            }
        }
    }
}
