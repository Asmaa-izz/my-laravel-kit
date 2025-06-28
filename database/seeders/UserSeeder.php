<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::createOrFirst(['email' => 'my@app.com'], [
            'email' => 'my@app.com',
            'name' => 'username',
            'password' => Hash::make('123'),
        ])->assignRole('admin');
    }
}
