<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = Role::all()->keyBy('name');

        // 1 Admin User
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@technofest.com',
            'password' => Hash::make('superadmin'),
            'role_id' => $roles['admin']->id,
            'email_verified_at' => now(),
            'created_at' => now()->subMonths(6),
            'updated_at' => now()->subMonths(6),
        ]);

        // 3 Moderator Users
        $moderatorNames = [
            'Organizer 1',
            'Organizer 2',
            'Organizer 3'
        ];

        foreach ($moderatorNames as $index => $moderatorName) {
            User::create([
                'name' => $moderatorName,
                'email' => 'organizer' . ($index + 1) . '@technofest.com',
                'password' => Hash::make('password123'),
                'role_id' => $roles['organizer']->id,
                'email_verified_at' => now()->subDays(rand(10, 60)),
                'created_at' => now()->subDays(rand(30, 180)),
                'updated_at' => now()->subDays(rand(1, 30)),
            ]);
        }
    }
}
