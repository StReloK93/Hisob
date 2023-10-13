<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainDocument extends Model
{
    protected $with = ['files', 'positionTypes'];

    protected $fillable = [
        'name',
        'confirm_date',
        'description',
    ];

    
    public function files()
    {
        return $this->hasMany(MainDocumentFiles::class);
    }

    public function positionTypes()
    {
        return $this->hasMany(PositionType::class);
    }

    protected $casts = [
        'confirm_date' => 'date:Y-m-d',
    ];
}
