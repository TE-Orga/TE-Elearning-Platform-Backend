<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // إنشاء موظف
        User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'employee@te.com',
            'password' => Hash::make('password123'),
            'phone_number' => '0600000000',
            'role' => 'employee',
            'department' => 'IT',
            'valuestream' => 'Development',
            'manager' => 'Jane Smith',
            'te_id' => 'TE001',
        ]);

        // إنشاء متعاقد
        User::create([
            'first_name' => 'Alice',
            'last_name' => 'Johnson',
            'email' => 'contractor@company.com',
            'password' => Hash::make('password123'),
            'phone_number' => '0600000001',
            'role' => 'contractor',
            'nationality' => 'Moroccan',
            'enterprise' => 'Tech Solutions',
            'visit_period' => '6 months',
            'collab_field' => 'Software Development',
        ]);

        // إنشاء زائر
        User::create([
            'first_name' => 'Robert',
            'last_name' => 'Brown',
            'email' => 'visitor@gmail.com',
            'password' => Hash::make('password123'),
            'phone_number' => '0600000002',
            'role' => 'visitor',
            'date_visit' => now(),
            'etablissement' => 'ABC Company',
            'visit_purpose' => 'Business Meeting',
        ]);

        // إنشاء المزيد من الموظفين
        User::factory(5)->create([
            'role' => 'employee',
            'department' => 'Engineering',
            'valuestream' => 'Production',
            'manager' => 'John Manager',
        ]);

        // إنشاء المزيد من المتعاقدين
        User::factory(3)->create([
            'role' => 'contractor',
            'nationality' => 'Moroccan',
            'enterprise' => 'Various Companies',
        ]);

        // إنشاء المزيد من الزوار
        User::factory(2)->create([
            'role' => 'visitor',
            'date_visit' => now(),
        ]);
    }
}
