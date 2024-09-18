<?php

namespace Database\Seeders;

use App\Models\Role\Role;
use App\Models\Role\RoleRight;
use App\Models\User\User;
use Illuminate\Database\Seeder;

use App\Models\Right;

class RightSeeder extends Seeder
{
    public function run(): void {
        $data = [
            [
                'code' => 'user.view',
                'description' => "Раздел \"Сотрудники\"",
            ],
            [
                'code' => 'role.view',
                'description' => "Раздел \"Роли\"",
            ],
            [
                'code' => 'right.moderate',
                'description' => "Редактирование прав",
            ],
            [
                'code' => 'user.invite',
                'description' => "Отправка приглашений на регистрацию",
            ],
        ];

        Right::upsert($data, ['code'], ['description']);

        $adminRole = Role::where('code', Role::ADMIN)->first();

        foreach (Right::all() as $right) {
            if (!RoleRight::where('right_id', $right->id)->where('role_id', $adminRole->id)->exists()) {
                RoleRight::create([
                    'right_id' => $right->id,
                    'role_id' => $adminRole->id
                ]);
            }
        }
    }
}
