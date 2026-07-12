<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; 
use Spatie\Permission\Models\Role; 
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $roleSuperAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $roleAdmin = Role::firstOrCreate(['name' => 'Admin']);
        $roleContributor = Role::firstOrCreate(['name' => 'Contributor']);

        $superAdmin = User::firstOrCreate(
            [
                'email' => 'superadmin@himasista.com' 
            ],
            [
                'name' => 'Super Administrator',
                'password' => Hash::make('password123') 
            ]
        );
        $superAdmin->assignRole($roleSuperAdmin);

        $admin = User::firstOrCreate(
            [
                'email' => 'admin@himasista.com' 
            ],
            [
                'name' => 'Admin Harian',
                'password' => Hash::make('password123') 
            ]
        );
        $admin->assignRole($roleAdmin);

        $contributor = User::firstOrCreate(
            [
                'email' => 'contributor@himasista.com' 
            ],
            [
                'name' => 'Kontributor Berita',
                'password' => Hash::make('password123') 
            ]
        );
        $contributor->assignRole($roleContributor);
    }
}