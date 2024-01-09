<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Carbon\Carbon;
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
            'firstname' => 'Librarian',
            'middle_initial' => 'P.',
            'email' => env('ADMIN_EMAIL', 'admin@admin.com'),
            'password' => 'password',
            'is_admin' => true,
            'type' => 'Faculty',
            'email_verified_at' => Carbon::now()->toDateTimeString()
        ];

        if(!User::where('email', '=', $adminUser['email'])->exists()) {
            User::create($adminUser);
        }
        
    }
}
