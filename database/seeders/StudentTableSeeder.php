<?php

namespace Database\Seeders;

use App\Models\Employer;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable('students')) {
            Student::truncate();
            Student::create([
                'name'      => 'student',
                'email'     => 'student@gmail.com',
                'password'  => Hash::make(12345678),
                'student_code'=>'637673',
                'is_active' => 1,
                'facuty_id' =>1,
            ]);

        }
    }
}
