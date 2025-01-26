<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = [
            "role-list",
            "role-create",
            "role-edit",
            "role-delete",
        ];

        foreach ($permission as $key => $permission){
            $permission = Permission::create(['name' => $permission]);

        }
    }
}
