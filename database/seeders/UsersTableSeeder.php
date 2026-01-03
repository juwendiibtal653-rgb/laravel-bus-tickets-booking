<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
            ],
            [
                'id'             => 2,
                'name'           => 'Arya',
                'email'          => 'KetuaStress@gmail.com',
                'password'       => bcrypt('12345678'),
                'remember_token' => null,
            ],
            [
                'id'             => 3,
                'name'           => 'Zuwen',
                'email'          => 'ZuwenGanteng@gmail.com',
                'password'       => bcrypt('12345678'),
                'remember_token' => null,
            ],
            [
                'id'             => 4,
                'name'           => 'Sidan',
                'email'          => 'Sidan04@Gmail.com',
                'password'       => bcrypt('12345678'),
                'remember_token' => null,
            ],
        ];

        User::upsert($users, ['id'], ['name', 'email', 'password', 'remember_token']);
    }
}
