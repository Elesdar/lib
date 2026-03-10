<?php

namespace Database\Seeders;

use App\Events\UserCreatedEvent;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create(['name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'), ]);

        $user2 = User::factory()->create(['name' => 'Postman User',
            'email' => 'postman@gmail.com',
            'password' => Hash::make('password'), ]);

        UserCreatedEvent::dispatch($user);
        UserCreatedEvent::dispatch($user2);
    }
}
