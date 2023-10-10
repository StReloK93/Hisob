<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $with = [
        'products',
    ];


    protected $fillable = [
        'name',
        'isActive',
        'main_document_id',
        'number_in_document',
        'position_type_id',
    ];
    

    public function products()
    {
        return $this->hasMany(PositionProduct::class);
    }


    protected $casts = [
        'isActive' => 'boolean',
        'main_document_id' => 'integer',
        'number_in_document' => 'integer',
        'position_type_id' => 'integer',
    ];

}
