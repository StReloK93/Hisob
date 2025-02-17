<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class EmployeProduct extends Model
{
    use HasFactory;

    protected $with = [
        'product',
    ];

    protected $fillable = [
        'employe_id',
        'product_id',
        'position_id',
        'report_id',
        'count',
        'nomenclature',
        'price',
        'date_of_receipt',
        'toggle_confirmation',
        'date_write_off',
        'toggle_write_off',
        'expiration_date'
    ];

    public function Product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function employe()
    {
        return $this->belongsTo(Employe::class);
    }

    protected $casts = [
        'date_write_off' => 'date:Y-m-d',
        'date_of_receipt' => 'date:Y-m-d',
        'employe_id' => 'integer',
        'position_product_id' => 'integer',
        'count' => 'integer',
        'toggle_confirmation' => 'boolean',
        'toggle_write_off' => 'boolean',
    ];

    public function getTimerAttribute() {
        $today = now();
        $current = Carbon::parse($this->expiration_date);
        return $today->diffInDays($current);
    }


}
