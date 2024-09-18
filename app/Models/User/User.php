<?php

namespace App\Models\User;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Role\Role;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // protected
    protected $table = 'user';

    protected $fillable = [
        'email',
        'password',
        'first_name',
        'middle_name',
        'last_name',
        'role_id',
        'created_at',
        'updated_at'
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $primaryKey = 'id';

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // public
    public function Role(): HasOne {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function setPasswordAttribute(string $password): void {
        $this->attributes['password'] = Hash::make($password);
    }
}
