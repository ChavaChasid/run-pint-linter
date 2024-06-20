<?php

use App\Models\User;
use App\Notifications\SendEmail;
use Database\Seeders\PermissionSeeder;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Notification;

it('returns hidden attributes', function () {
    expect(User::make())
        ->getHidden()->toEqual(['password', 'remember_token']);
});

it('returns a dispaly name', function () {
    expect(User::make(['first_name' => 'first_name', 'last_name' => 'last_name']))
        ->display_name->toEqual('last_name, first_name');
});

it('returns dispaly name from getFilamentName', function () {
    $user = User::make(['first_name' => 'first_name', 'last_name' => 'last_name']);
    expect($user->getFilamentName())->toEqual($user->display_name);
});

it('allows admin and team-lead users to create a new user', function () {
    $this
        ->seed(PermissionSeeder::class)
        ->asAdminUser()
        ->get('/users/create')
        ->assertStatus(200);
});

it('does not allow regular users to create a new user', function () {
    $this
        ->asUser()
        ->get('/users/create')
        ->assertStatus(403);
});

it('allow admin to edit a user', function () {
    $this
        ->seed(PermissionSeeder::class)
        ->asAdminUser()
        ->get('/users/1/edit')
        ->assertStatus(200);
});

it('allow user himself to edit a user', function () {
    $this
        ->asUser()
        ->get('/users/1/edit')
        ->assertStatus(200);
});

it('does not allow regular users to edit a user', function () {
    User::factory()->create();
    $this
        ->asUser()
        ->get('/users/1/edit')
        ->assertStatus(403);
});

it('Sends an email to user to reset a password', function () {

    $user = User::factory()->create();
    Notification::fake();

    $mailMessage = (new MailMessage)->subject('New user registration');
    $user->notify(new SendEmail($mailMessage));

    Notification::assertSentTo($user, SendEmail::class);
    Notification::assertCount(1);
});
