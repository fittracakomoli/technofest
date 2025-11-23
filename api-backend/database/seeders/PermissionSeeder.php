<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::insert([
            ['name' => 'admin', 'display_name' => 'Admin Access', 'group' => 'admin', 'description' => 'Full admin access', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'organizer', 'display_name' => 'Organizer Access', 'group' => 'organizer', 'description' => 'Organizer access', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'customer', 'display_name' => 'Customer Access', 'group' => 'customer', 'description' => 'Customer access', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
