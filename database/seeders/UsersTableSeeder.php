<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//Models
use App\Models\User;
use App\Models\Apartment;

// Helpers
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users =
        [
            [
                'first_name' => 'Samuele',
                'last_name' => 'Stivaletti',
                'date_of_birth' => '1998-03-06',
                'email' => 'samuele@boolean.com',
                'password' => 'password'
            ],
            [
                'first_name' => 'Stefan',
                'last_name' => 'Enache',
                'date_of_birth' => '1995-08-20',
                'email' => 'stefan@boolean.com',
                'password' => 'password'
            ],
            [
                'first_name' => 'Luca',
                'last_name' => 'Vita',
                'date_of_birth' => '1997-04-28',
                'email' => 'luca@boolean.com',
                'password' => 'password'
            ],
            [
                'first_name' => 'Simone',
                'last_name' => 'Buscemi',
                'date_of_birth' => '1999-11-22',
                'email' => 'simone@boolean.com',
                'password' => 'password'
            ],
            [
                'first_name' => 'Daniel',
                'last_name' => 'Samfirescu',
                'date_of_birth' => '1992-09-11',
                'email' => 'daniel@boolean.com',
                'password' => 'password'
            ],
        ];

        Schema::withoutForeignKeyConstraints(function () {
            User::truncate();
        });

        foreach ($users as $user) {
            User::create([
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'date_of_birth' => $user['date_of_birth'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
            ]);
        }
    }
}
