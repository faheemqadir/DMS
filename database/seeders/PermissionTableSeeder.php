<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
  
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            "role-list",
            "role-create",
            "role-edit",
            "role-delete",
            "customer-list",
            "customer-create",
            "customer-edit",
            "customer-delete",
            "approve-order",
            "assign-order",
            "reports",
            "items-list",
            "items-create",
            "items-edit",
            "items-delete",
            "items-update",
            "role-view",
            "customer-view",
            "user-list",
            "user-create",
            "user-edit",
            "user-delete",
            "user-view",
            "rider-list",
            "rider-create",
            "rider-view",
            "rider-edit",
            "rider-delete",
            "order-list",
            "order-view",
            "order-edit",
            "order-delete",
            "setting-list"

        ];
     
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}