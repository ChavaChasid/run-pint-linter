<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public function asUser($user = null): static
    {
        $this->actingAs($user ?? User::factory()->create());

        return $this;
    }

    public function asAdminUser($user = null): static
    {
        $this->actingAs($user ?? User::factory()->create()->assignRole('admin'));

        return $this;
    }
}
