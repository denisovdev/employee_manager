<?php

namespace App\Models\Role;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleRight extends Model
{
    use HasFactory;
    
    // protected
    protected $table = 'role_right';

    protected $fillable = ['role_id', 'right_id', 'created_at', 'updated_at'];
    
    protected $primaryKey = 'id';
    
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
