<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PositionProduct extends Model
{
    use HasFactory;

    protected $with = [
        'product'
    ];

    protected $fillable = [
        'position_id',
        'product_id',
        'count',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    protected $casts = [
        'count' => 'integer',
        'position_id' => 'integer',
        'product_id' => 'integer',
    ];
}
