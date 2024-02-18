<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;


    protected $table = 'report';
    
    public $timestamps = false;

    protected $fillable = [
        'name',
        'confirmed',
        'report_type_id',
        'file_source',
        'created_at',
    ];


    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i'
    ];
    
}
