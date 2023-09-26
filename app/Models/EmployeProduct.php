<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeProduct extends Model
{
    use HasFactory;

    protected $with = [
        'product'
    ];

    protected $fillable = [
        'employe_id',
        'product_id',
        'count',
        'nomenclature',
        'price',
        'date_of_receipt',
        'toggle_confirmation',
        'date_write_off',
        'toggle_write_off',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    public function scopeSpecialProducts($query)
    {
        return $query->whereHas('product', function($query) {
            $query->where('product_type_id' , 1);
        });
    }

    public function scopeMainProducts($query)
    {
        return $query->whereHas('product', function($query) {
            $query->where('product_type_id' , 2);
        });
    }

    protected $casts = [
        'date_of_receipt' => 'date:Y-m-d',
        'employe_id' => 'integer',
        'product_id' => 'integer',
        'count' => 'integer',
        'toggle_confirmation' => 'boolean',
        'toggle_write_off' => 'boolean',
    ];
    
}
