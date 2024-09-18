<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Right extends Model
{
    use HasFactory;

    // protected
    protected $table = 'right';

    protected $fillable = ['code', 'description', 'created_at', 'updated_at'];
    
    protected $primaryKey = 'id';
    
    protected $unique = ['code'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
