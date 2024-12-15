<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'id_user' => 3,
            'nama_user' => 'admin',
            'level' => 'admin',
            'password' => md5('superadmin'),
            'pin_user' => '123456',
        ]);
    }
}
