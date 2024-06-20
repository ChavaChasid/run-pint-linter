<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    protected static ?string $password;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
        ]);

        // User::factory(10)->create();
        User::factory()->create([
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'phone_number' => '05'.fake()->randomNumber(8, true),
            'phone_number_alt' => '05'.fake()->randomNumber(8, true),
            'address' => ['city' => 'Ashdod', 'street' => 'aaa', 'house_number' => 1],
            'remember_token' => Str::random(10),
        ]);

    }
}
