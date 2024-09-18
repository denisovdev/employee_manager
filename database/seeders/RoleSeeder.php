<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Role\Role;

class RoleSeeder extends Seeder
{
    public function run() {
        $data = [
            [
                'code' => 'admin',
                'title' => 'Администратор системы',
            ]
        ];

        Role::upsert($data, ['code'], ['title']);
    }
}
