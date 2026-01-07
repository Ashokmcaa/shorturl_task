<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Insert Roles (Raw SQL)
        |--------------------------------------------------------------------------
        */
        DB::statement("
            INSERT INTO roles (name) VALUES
            ('SuperAdmin'),
            ('Admin'),
            ('Member'),
            ('Sales'),
            ('Manager')
        ");

        /*
        |--------------------------------------------------------------------------
        | Insert Default Company
        |--------------------------------------------------------------------------
        */
        DB::statement("
            INSERT INTO companies (name, created_at, updated_at)
            VALUES ('Main Company', NOW(), NOW())
        ");

        /*
        |--------------------------------------------------------------------------
        | Insert SuperAdmin User
        |--------------------------------------------------------------------------
        | role_id = 1  -> SuperAdmin
        | company_id = 1 -> Main Company
        */
        DB::statement("
            INSERT INTO users (name, email, password, role_id, company_id, created_at, updated_at)
            VALUES (
                'Super Admin',
                'superadmin@example.com',
                '" . Hash::make('password') . "',
                1,
                1,
                NOW(),
                NOW()
            )
        ");
    }
}
