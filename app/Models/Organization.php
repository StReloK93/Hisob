<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'short_name',
        'isActive',
    ];


    protected $casts = [
        'isActive' => 'boolean',
    ];


    public function scopeAccessOrganizations($query)
    {
        
        $organizations = [];
        foreach (Auth::user()->organizations as $key => $item) {
            $organizations[] = $item->organizations_id;
        }

        return $query->whereIn('id', $organizations);
    }
}
