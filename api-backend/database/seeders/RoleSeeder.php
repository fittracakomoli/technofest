<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            ['name' => 'admin', 'display_name' => 'Administrator', 'description' => 'Full system access', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'organizer', 'display_name' => 'Organizer', 'description' => 'Manage & create event', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'customer', 'display_name' => 'Customer', 'description' => 'Buy event ticket', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
