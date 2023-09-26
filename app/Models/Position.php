<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $with = ['products'];

    protected $fillable = [
        'name',
        'isActive',
    ];

    public function products()
    {
        return $this->hasMany(PositionProduct::class);
    }


    protected $casts = [
        'isActive' => 'boolean',
    ];

}
