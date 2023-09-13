<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    protected $with = ['productType'];

    protected $fillable = [
        'name',
        'isActive',
        'expiration_date',
        'product_type_id',
    ];


    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }


    
    // protected $connection = 'oracle';
    // protected $table = 'nmmc.t_materials';

    // protected static function booted()
    // {
    //     static::addGlobalScope('ancient', function (Builder $builder) {
    //         $builder->select('r', 'name', 'n', 'measure', 'price', 'n_gr', 'n_subgr', 'complete', 'type');
    //     });
    // }
}
