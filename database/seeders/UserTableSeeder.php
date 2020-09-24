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
        if (Schema::hasTable('users'))
        {
            User::truncate();
            User::create([
                'name'=>'admin',
                'email'=>'admin@gmail.com',
                'password'=>Hash::make(12345678),
                'role'=>0,
                'is_active'=>1
            ]);
            User::create([
                'name'=>'employer',
                'email'=>'employer@gmail.com',
                'password'=>Hash::make(12345678),
                'role'=>1,
                'is_active'=>1
            ]);
            User::create([
                'name'=>'student',
                'email'=>'student@gmail.com',
                'password'=>Hash::make(12345678),
                'role'=>2,
                'is_active'=>1
            ]);

        }
        if (Schema::hasTable('user_infos')){
            User_info::truncate();
            User_info::create([
                'user_id'=>1
            ]);
        }

        if (Schema::hasTable('employers')){
            Employer::truncate();
            Employer::create([
                'user_id'=>2
            ]);
        }

        if (Schema::hasTable('students')){
            Student::truncate();
            Student::create([
                'user_id'=>3
            ]);
        }
    }
}
