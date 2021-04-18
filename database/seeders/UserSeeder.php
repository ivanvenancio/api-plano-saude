<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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
        DB::table('users')->insert([
            'name' => 'Ivan Venancio',
            'email' => 'user@user.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123mudar'),
            'remember_token' => Str::random(10),
        ]);
    }
}
