<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PositionProduct extends Model
{
    use HasFactory;

    protected $with = [
        'product',
        'workingCondition'
    ];

    protected $fillable = [
        'position_id',
        'product_id',
        'count',
        'expiration_date',
        'working_condition_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    public function workingCondition()
    {
        return $this->belongsTo(WorkingCondition::class);
    }

    protected $casts = [
        'count' => 'integer',
        'position_id' => 'integer',
        'product_id' => 'integer',
        'working_condition_id' => 'integer',
    ];
}
