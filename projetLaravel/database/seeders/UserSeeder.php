<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Adhérent', 'email' => 'adherent@bibliotech.test', 'role' => 'adherent'],
            ['name' => 'Bibliothécaire', 'email' => 'bibliothecaire@bibliotech.test', 'role' => 'bibliothecaire'],
            ['name' => 'Admin', 'email' => 'admin@bibliotech.test', 'role' => 'admin'],
        ];

        foreach ($users as $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make('password'),
            ]);
            $user->forceFill(['role' => $userData['role']])->save();
        }
    }
}
