<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;


class Employe extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_number',
        'name',
        'hiring_date',
        'gender',
        'profession',
        'organization_id',
        'division_id',
        'heigth',
        'size_cloth',
        'size_head',
        'size_shoes',
    ];


    // protected $appends = ['end_timer'];

    protected $with = ['organization'];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function position()
    {
        return $this->hasMany(EmployePosition::class);
    }

    public function scopeAccessOrganizations($query)
    {
        
        $organizations = [];
        foreach (Auth::user()->organizations as $key => $item) {
            $organizations[] = $item->organizations_id;
        }

        return $query->whereIn('organization_id', $organizations);
    }



    // public function getEndTimerAttribute() {
    //     return EmployeProduct::where('employe_id', $this->id)
    //     ->get()
    //     ->filter(function ($product, $key) {
    //         return $product->timer < 300;
    //     });
    // }

    protected $casts = [
        'hiring_date' => 'date:Y-m-d',
        'gender' => 'boolean',
        'organization_id' => 'integer',
        'division_id' => 'integer',
    ];
}
