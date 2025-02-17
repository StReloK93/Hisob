<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
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

    public function position()
    {
        return $this->hasMany(EmployePosition::class)->select('id', 'employe_id', 'position_id', 'organization_id', 'hiring_date', 'profession');
    }

    public function scopeAccessOrganizations($query)
    {
        $organization_ids = Auth::user()->organizations->pluck('organizations_id')->all();

        return $query->whereHas('position', function (Builder $query) use ($organization_ids) {
            $query->whereIn('organization_id', $organization_ids)
                  ->orderBy('id', 'desc')
                  ->limit(1);
        });
    }

    protected $casts = [
        'hiring_date' => 'date:Y-m-d',
        'gender' => 'boolean',
        'organization_id' => 'integer',
        'division_id' => 'integer',
    ];
}
