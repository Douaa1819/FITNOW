<?php

use App\Models\User;
use Faker\Factory;
use Illuminate\Support\Facades\Hash;


//register
it('user can register and login', function () {
    $user = User::factory()->create([
        'password' => Hash::make($password = 'i-love-laravel'), // Set a known password
    ]);
    $response = $this->postJson('/api/auth/login', [
        'email' => $user->email,
        'password' => $password,
    ]);

    $response->assertStatus(200)
             ->assertJson([
                 'status' => true,
                 'message' => 'User Logged In Successfully',
             ]);
});


//login
it('allows a user to log in', function () {
    // Create a user with a known password
    $user = User::factory()->create([
        'password' => Hash::make($password = 'secret'),
    ]);

    $response = $this->postJson('/api/auth/login', [
        'email' => $user->email,
        'password' => $password,
    ]);
    $response->assertStatus(200)
             ->assertJson([
                 'status' => true,
                 'message' => 'User Logged In Successfully',
             ]);
});

// Logout

it('allows a user to logout', function () {
    $user = User::factory()->create();
    $token = $user->createToken('TestToken')->plainTextToken;
    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->postJson('/api/progress/logout');

    $response->assertStatus(200)
             ->assertJson([
                 'message' => 'logged out',
             ]);
});

