<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = User::create([
            'userId' => Str::orderedUuid(),
            'name' => 'Superadmin',
            'email' => 'superadmin@k-popindonesia.id',
            'password' => Hash::make('Superadmin2024!'),
        ]);
        $superadmin->assignRole('Super Admin');
    }
}
