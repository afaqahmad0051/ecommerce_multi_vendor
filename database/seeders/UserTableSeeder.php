<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            //Admin Data
            [
                'name' => 'Afaq Ahmad',
                'username' => 'afaqahmad0051',
                'email' => 'afaqa0051@gmail.com',
                'phone' => '+92 306 9696035',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
                'status' => 'active',
            ],
            //Vendor Data
            [
                'name' => 'Hassan Vendor',
                'username' => 'vendor12',
                'email' => 'vendor@gmail.com',
                'phone' => '+92 306 1234567',
                'password' => Hash::make('12345678'),
                'role' => 'vendor',
                'status' => 'active',
            ],
            //User Data
            [
                'name' => 'User',
                'username' => 'user12',
                'email' => 'user@gmail.com',
                'phone' => '+92 306 7654321',
                'password' => Hash::make('12345678'),
                'role' => 'user',
                'status' => 'active',
            ]
        ]);
    }
}
