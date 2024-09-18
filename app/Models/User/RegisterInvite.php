<?php

namespace App\Models\User;

use App\Models\Role\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RegisterInvite extends Model
{
    use HasFactory;

    protected $table = 'register_invite';

    protected $primaryKey = 'id';

    protected $fillable = ['email', 'role_id', 'token', 'send_at', 'accepted_at'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'send_at' => 'datetime',
        'accepted_at' => 'datetime'
    ];

    public function role(): HasOne
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }
}
