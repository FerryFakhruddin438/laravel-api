<?php

namespace Database\Seeders;

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
        collect([
            [
                'name' => 'Ferry Fakhruddin',
                'email' => 'ferry@test.test',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Jane Doe',
                'email' => 'jane@test.test',
                'password' => Hash::make('password'),
            ]
        ])->each(function ($user) {
            \App\Models\User::create($user);
        });
    }
}
