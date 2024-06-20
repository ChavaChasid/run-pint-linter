<?php

it('redirects unauthorized users to the login page', function () {
    $this
        ->get('/')
        ->assertRedirect('/login');
});

it('allows logged in users to access the main panel', function () {
    $this
        ->asUser()
        ->get('/')
        ->assertStatus(200);
});
