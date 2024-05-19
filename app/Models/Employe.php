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
        'gender',
        'division_id',
        'heigth',
        'size_cloth',
        'size_head',
        'size_shoes',

        'buyruq_raqami',
        'ishdan_boshagan_kuni',
    ];


    // protected $appends = ['end_timer'];


    public function position()
    {
        return $this->hasMany(EmployePosition::class)->select('id', 'employe_id', 'position_id', 'organization_id', 'hiring_date', 'profession');
    }

    public function scopeAccessOrganizations($query)
    {
        
        $organizations = [];
        foreach (Auth::user()->organizations as $key => $item) {
            $organizations[] = $item->organizations_id;
        }

        return $query->whereIn('organization_id', $organizations);
    }

    protected $casts = [
        'hiring_date' => 'date:Y-m-d',
        'gender' => 'boolean',
        'organization_id' => 'integer',
        'division_id' => 'integer',
    ];
}
