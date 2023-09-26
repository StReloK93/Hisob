<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_number',
        'name',
        'hiring_date',
        'gender',
        'organization_id',
        'division_id',
        'heigth',
        'size_cloth',
        'size_head',
        'size_shoes',
    ];

    protected $with = [
        'organization',
        'position',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function position()
    {
        return $this->hasMany(EmployePosition::class);
    }

    protected $casts = [
        'hiring_date' => 'date:Y-m-d',
        'gender' => 'boolean',
        'organization_id' => 'boolean',
        'division_id' => 'boolean',
    ];
}
