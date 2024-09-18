<?php

namespace App\Exports;

use App\Models\User\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportUser implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select('user.last_name', 'user.first_name', 'user.middle_name', 'user.email', 'role.title')
            ->leftJoin('role', 'role.id', '=', 'user.role_id')
            ->orderBy('user.last_name')
            ->get();
    }
}
