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
        'user_id',
        'name',
        'confirmed',
        'report_type_id',
        'file_source',
        'created_at',
    ];


    protected $with = [
        'user',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i',
        'confirmed' => 'boolean'
    ];
    
}
