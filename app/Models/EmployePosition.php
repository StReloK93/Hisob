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
        'organization_id',
        'hiring_date',
        'profession',
    ];


    protected $with = [
        'position',
        'organization'
    ];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class)->select('id', 'short_name');
    }

    protected $casts = [
        'employe_id' => 'integer',
        'position_id' => 'integer',
    ];
}
