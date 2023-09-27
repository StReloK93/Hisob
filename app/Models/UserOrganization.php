<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOrganization extends Model
{
    use HasFactory;

    protected $casts = [
        'user_id' => 'integer',
        'organizations_id' => 'integer',
    ];
}
