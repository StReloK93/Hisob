<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    protected $with = [
        'role'
    ];

    protected $fillalbe = [
        'user_id',
        'role_id',
    ];


    public function role()
    {
        return $this->belongsTo(Role::class);
    }


    protected $casts = [
        'user_id' => 'integer',
        'role_id' => 'integer',
    ];

}
