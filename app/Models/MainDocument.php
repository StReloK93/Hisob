<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainDocument extends Model
{
    protected $with = ['files'];

    protected $fillable = [
        'name',
        'confirm_date',
        'description',
    ];

    
    public function files()
    {
        return $this->hasMany(MainDocumentFiles::class);
    }


    protected $casts = [
        'confirm_date' => 'date:Y-m-d',
    ];
}
