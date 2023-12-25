<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Muhamad Aski Baihaki',
                'email' => 'baihakiaski@gmail.com',
                'password' => bcrypt('password'),
                'position' => 'Web Programmer',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
