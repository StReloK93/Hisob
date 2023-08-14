<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_number',
        'first_name',
        'last_name',
        'second_name',
        'position_id',
        'hiring_date',
        'gender',
        'organization_id',
        'division_id',
    ];

    protected $with = [
        'organization',
        'position',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function Position()
    {
        return $this->belongsTo(position::class);
    }
}
