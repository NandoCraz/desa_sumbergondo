<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'username' => 'adminarno',
            'email' => 'nsparkeladmin@admin.com',
            'no_hp' => '081234567890',
            // 'picture_profile' => 'profilePicture/adminArno.jpg',
            'role' => 'admin',
            'password' => bcrypt('adminarno2022'),
        ]);
        User::create([
            'name' => 'ZacharyShin',
            'username' => 'shinarno',
            'email' => 'zacharyshin@gmail.com',
            'no_hp' => '081234567890',
            // 'picture_profile' => 'profilePicture/adminArno.jpg',
            'role' => 'user',
            'password' => bcrypt('zacharyshin'),
        ]);
    }
}
