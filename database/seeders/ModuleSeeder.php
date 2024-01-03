<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\ModulePermission;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            [

                'title' => 'Admin',
                'permissions' => [
                    [

                        'title' => 'View Admin'
                    ],
                    [

                        'title' => 'Add Admin'
                    ],
                    [
                        'title' => 'Edit Admin'
                    ],
                    [
                        'title' => 'Delete Admin'
                    ],
                    [
                        'title' => 'Change Status Admin'
                    ]
                ]
            ],
            [

                'title' => 'Student',
                'permissions' => [
                    [

                        'title' => 'View Student'
                    ],
                    [

                        'title' => 'Add Student'
                    ],
                    [
                        'title' => 'Edit Student'
                    ],
                    [
                        'title' => 'Delete Student'
                    ],
                    [
                        'title' => 'Change Status Student'
                    ]
                ]
            ],
            [

                'title' => 'Teacher',
                'permissions' => [
                    [

                        'title' => 'View Teacher'
                    ],
                    [

                        'title' => 'Add Teacher'
                    ],
                    [
                        'title' => 'Edit Teacher'
                    ],
                    [
                        'title' => 'Delete Teacher'
                    ],
                    [
                        'title' => 'Change Status Teacher'
                    ]
                ]
            ],

            [

                'title' => 'Role',
                'permissions' =>    [
                    [

                        'title' => 'View Role'
                    ],
                    [
                        'title' => 'Add Role'
                    ],
                    [
                        'title' => 'Edit Role'
                    ],
                    [
                        'title' => 'Delete Role'
                    ],
                    [
                        'title' => 'Change Status Role'
                    ]
                ]
            ],
            [
                'title' => 'Banner',
                'permissions' => [
                    [

                        'title' => 'View Banner'
                    ],
                    [
                        'title' => 'Add Banner'
                    ],
                    [
                        'title' => 'Edit Banner'
                    ],
                    [
                        'title' => 'Delete Banner'
                    ],
                    [
                        'title' => 'Change Status Banner'
                    ]
                ]
            ],
            [
                'title' => 'Content',
                'permissions' => [
                    [

                        'title' => 'View Content'
                    ],
                    [
                        'title' => 'Add Content'
                    ],
                    [
                        'title' => 'Edit Content'
                    ],
                    [
                        'title' => 'Delete Content'
                    ],
                    [
                        'title' => 'Change Status Content'
                    ]
                ]
            ],
            [
                'title' => 'Menu',
                'permissions' => [
                    [

                        'title' => 'View Menu'
                    ],
                    [
                        'title' => 'Add Menu'
                    ],
                    [
                        'title' => 'Edit Menu'
                    ],
                    [
                        'title' => 'Delete Menu'
                    ],
                    [
                        'title' => 'Change Status Menu'
                    ]
                ]
            ],
            [
                'title' => 'Grade',
                'permissions' => [
                    [

                        'title' => 'View Grade'
                    ],
                    [
                        'title' => 'Add Grade'
                    ],
                    [
                        'title' => 'Edit Grade'
                    ],
                    [
                        'title' => 'Delete Grade'
                    ],
                    [
                        'title' => 'Change Status Grade'
                    ]
                ]
            ],
            [
                'title' => 'Subject',
                'permissions' => [
                    [

                        'title' => 'View Subject'
                    ],
                    [
                        'title' => 'Add Subject'
                    ],
                    [
                        'title' => 'Edit Subject'
                    ],
                    [
                        'title' => 'Delete Subject'
                    ],
                    [
                        'title' => 'Change Status Subject'
                    ]
                ]
            ]
        ];
        $dbModules = Module::pluck('title')->toArray();
        $dbPermissions = Permission::pluck('title')->toArray();
        foreach ($modules as $module) {

            if (!in_array($module['title'], $dbModules)) {
                $mod = Module::create(['title' => $module['title']]);
            } else {
                $mod = Module::where('title', $module['title'])->first();
            }

            foreach ($module['permissions'] as $permission) {
                if (!in_array($permission['title'], $dbPermissions)) {
                    $per = Permission::create($permission);
                } else {
                    $per = Permission::where('title', $permission['title'])->first();
                }
                ModulePermission::updateOrCreate(
                    [
                        'module_id' => $mod->id,
                        'permission_id' => $per->id,
                    ],
                    [
                        'module_id' => $mod->id,
                        'permission_id' => $per->id,
                    ]
                );
            }
        }
    }
}
