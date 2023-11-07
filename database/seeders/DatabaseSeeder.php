<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Division;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Division::create([
            'divisionId'        => 'DV001',
            'divisionName'      => 'IT',
        ]);

        Division::create([
            'divisionId'        => 'DV002',
            'divisionName'      => 'Accounting',
        ]);

        Division::create([
            'divisionId'        => 'DV003',
            'divisionName'      => 'GA',
        ]);

        Employee::create([
            'employeeId'          => '1234567891',
            'name'                => 'Adam Zein',
            'divisionId'          => 'DV001',
            'email'               => 'adamzein345@gmail.com',
            'tel'                 => '081316671373',
            'address'             => 'Bekasi',
        ]);

        Employee::create([
            'employeeId'          => '1234567892',
            'name'                => 'Indra',
            'divisionId'          => 'DV003',
            'email'               => 'indra@gmail.com',
            'tel'                 => '081316671374',
            'address'             => 'Bekasi',
        ]);

        Employee::create([
            'employeeId'          => '1234567893',
            'name'                => 'Rasyif',
            'divisionId'          => 'DV001',
            'email'               => 'rasyif@gmail.com',
            'tel'                 => '081316671375',
            'address'             => 'Bekasi',
        ]);

        Employee::create([
            'employeeId'          => '1234567894',
            'name'                => 'Benno',
            'divisionId'          => 'DV001',
            'email'               => 'benno@gmail.com',
            'tel'                 => '081316671376',
            'address'             => 'Bekasi',
        ]);

        User::create([
            'userId'              => Str::uuid(), 
            'employeeId'          => '1234567891',
            'role'                => 'Admin',
            'password'            => Hash::make('ciracas24'),
        ]);

        User::create([
            'userId'              => Str::uuid(), 
            'employeeId'          => '1234567892',
            'role'                => 'Client',
            'password'            => Hash::make('ciracas24'),
        ]);

        User::create([
            'userId'              => Str::uuid(), 
            'employeeId'          => '1234567893',
            'role'                => 'Technician',
            'password'            => Hash::make('ciracas24'),
        ]);

        User::create([
            'userId'              => Str::uuid(), 
            'employeeId'          => '1234567894',
            'role'                => 'Manager',
            'password'            => Hash::make('ciracas24'),
        ]);

        Category::create([
            'categoryId'           => "CT001",
            'categoryName'         => "Hardware",
        ]);

        Category::create([
            'categoryId'           => "CT002",
            'categoryName'         => "Software",
        ]);

        
    }
}
