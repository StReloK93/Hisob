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
        return $this->belongsTo(Organization::class)->select('id', 'short_name');
    }

    public function position()
    {
        return $this->hasMany(EmployePosition::class)->select('id', 'employe_id', 'position_id');
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
