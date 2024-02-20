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
        // 'employe'
    ];

    // protected $appends = ['expiration_date','timer'];

    protected $fillable = [
        'employe_id',
        'product_id',
        'position_id',
        'count',
        'nomenclature',
        'price',
        'date_of_receipt',
        'toggle_confirmation',
        'date_write_off',
        'toggle_write_off',
    ];

    public function Product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function employe()
    {
        return $this->belongsTo(Employe::class);
    }

    // public function scopeSpecialProducts($query)
    // {
    //     return $query->whereHas('product', function($query) {
    //         $query->whereHas('product', function($query) {
    //             $query->where('product_type_id' , 1);
    //         });
    //     });
    // }

    public function scopeAccessOrganizations($query)
    {
        return $query->whereHas('employe', function ($query) {
            $query->accessOrganizations();
        });
    }




    // public function scopeMainProducts($query)
    // {
    //     return $query->whereHas('product', function($query) {
    //         $query->whereHas('product', function($query) {
    //             $query->where('product_type_id' , 2);
    //         });
    //     });
    // }

    protected $casts = [
        'date_write_off' => 'date:Y-m-d',
        'date_of_receipt' => 'date:Y-m-d',
        'employe_id' => 'integer',
        'position_product_id' => 'integer',
        'count' => 'integer',
        'toggle_confirmation' => 'boolean',
        'toggle_write_off' => 'boolean',
    ];
    

    // public function getExpirationDateAttribute() {
    //     if($this->positionProduct){
    //         $date = Carbon::parse($this->date_of_receipt)->addMonth($this->positionProduct->expiration_date)->format('Y-m-d');
    //         return $date;
    //     }
    //     else{
    //         return null;
    //     }
    // }


    public function getTimerAttribute() {
        $today = now();
        $current = Carbon::parse($this->expiration_date);
        return $today->diffInDays($current);
    }


}
