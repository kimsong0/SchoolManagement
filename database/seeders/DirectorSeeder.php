<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class DirectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        if (!User::where('role', 'director')->exists()) {
            User::create([
                'name' => 'Director ',
                'email' => 'song@gmail.com',
                'password' => Hash::make('12345678'), // Change for security
                'role' => 'director',
            ]);
        }
    }
    }

