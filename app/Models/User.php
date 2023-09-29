<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $with = [
        'organizations',
    ];

    protected $fillable = [
        'name',
        'login',
        'password',
    ];

    protected $appends = ['rolenames'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function organizations()
    {
        return $this->hasMany(UserOrganization::class);
    }

    public function roles()
    {
        return $this->hasMany(UserRole::class);
    }

    public function getRolenamesAttribute() {
        $array = [];

        foreach ($this->roles as $key => $item) {
            $array[] = $item->role->name;
        }

        return $array;
    }
}
