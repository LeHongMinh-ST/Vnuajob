<?php

namespace Database\Seeders;

use App\Models\Employer;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class EmployerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable('employers')) {
            Employer::truncate();
            Employer::create([
                'name'      => 'employer',
                'email'     => 'employer@gmail.com',
                'password'  => Hash::make(12345678),
                'title'     =>'Tuyển dụng',
                'is_active' => 1
            ]);

        }
    }
}
