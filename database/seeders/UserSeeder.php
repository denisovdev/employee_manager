<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User\User;

class UserSeeder extends Seeder {
    public function run() {
        $data = [
            [
                'email' => 'dxngee@gmail.com',
                'password' => Hash::make('admin'),
                'first_name' => 'Администратор',
                'last_name' => 'Системы',
                'role_id' => 1
            ]
        ];

        User::upsert($data, ['email'], ['password', 'first_name', 'last_name', 'role_id']);
    }
}
