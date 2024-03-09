<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = 'Rohit';
        $email = 'rohitjangir681@gmail.com';
        $password = Hash::make(1234);
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);
    }
}
