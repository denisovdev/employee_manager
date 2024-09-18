<?php

namespace App\Models\Role;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Right;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

    // protected
    protected $table = 'role';

    protected $fillable = ['code', 'title', 'created_at', 'updated_at'];

    protected $primaryKey = 'id';

    protected $unique = ['code'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // public
    public const ADMIN = 'admin';

    public function Rights() {
        return $this->belongsToMany(Right::class, 'role_right', 'role_id', 'right_id');
    }

    public function can(String $code) {
        $right = Right::where('code', $code)->first();
        return RoleRight::where('right_id', $right->id)->where('role_id', $this->id)->exists();
    }
}
