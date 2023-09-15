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
    ];

    protected $with = [
        'organization',
        'employePosition',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function employePosition()
    {
        return $this->hasMany(EmployePosition::class);
    }

    protected $casts = [
        'hiring_date' => 'date:Y-m-d',
    ];
}
