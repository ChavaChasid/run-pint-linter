<?php

use App\Models\Project;
use Database\Seeders\PermissionSeeder;

it('allows admin users to create a new project', function () {
    $this
        ->seed(PermissionSeeder::class)
        ->asAdminUser()
        ->get('/projects/create')
        ->assertStatus(200);
});

it('does not allow regular users to create a new project', function () {
    $this
        ->asUser()
        ->get('/projects/create')
        ->assertStatus(403);
});

it('allow admin and team-lead users to edit a project', function () {
    Project::factory()->create();
    $this
        ->seed(PermissionSeeder::class)
        ->asAdminUser()
        ->get('/projects/1/edit')
        ->assertStatus(200);
});

it('does not allow regular users to edit a new project', function () {
    Project::factory()->create();
    $this
        ->asUser()
        ->get('/projects/1/edit')
        ->assertStatus(403);
});
