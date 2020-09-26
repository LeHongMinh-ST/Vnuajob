<?php

namespace Database\Seeders;

use App\Models\Employer;
use App\Models\Student;
use App\Models\User_info;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
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
        if (Schema::hasTable('users')) {
            User::truncate();
            User::create([
                'name'      => 'admin',
                'email'     => 'admin@gmail.com',
                'password'  => Hash::make(12345678),
                'title'     =>'Quản trị viên',
                'is_active' => 1
            ]);

        }
    }
}
