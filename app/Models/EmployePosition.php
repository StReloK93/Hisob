<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployePosition extends Model
{
    use HasFactory;

    protected $fillable = [
        'employe_id',
        'position_id',
    ];


    protected $with = [
        'position'
    ];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }


    protected $casts = [
        'employe_id' => 'integer',
        'position_id' => 'integer',
    ];
}
