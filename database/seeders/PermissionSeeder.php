<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $roles = collect([
            'admin',
            'project-manager',
            'team-lead',
            'developer',
        ])
            ->map(function (?string $role) {
                Role::firstOrCreate(
                    ['name' => $role],
                );
            });

    }
}
