<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = [
            'lastname' => 'Admin',
            'firstname' => 'User',
            'middle_initial' => 'P.',
            'email' => env('ADMIN_EMAIL', 'admin@admin.com'),
            'password' => 'password',
            'is_admin' => true,
            'type' => 'Faculty'
        ];

        if(!User::where('email', '=', $adminUser['email'])->exists()) {
            User::create($adminUser);
        }
        
    }
}
