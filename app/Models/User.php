<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function account()
    {
        return $this->hasOne(Account::class);
    }

    public function population()
    {
        return $this->hasOne(Population::class);
    }

    // get village name from account and village
    public function getVillageNameAttribute()
    {
        return $this->account->village->name;
    }

    // create user from population data
    public static function createFromPopulation($request) : User
    {
        $request = (object) $request;
        $user = new User();
        $user->name = $request->name;
        $user->password = bcrypt($request->family_card_id);
        $user->save();

        $account = new Account();
        $account->user_id = $user->id;
        $account->village_id = $request->village_id;
        $account->full_name = $user->name;
        $account->address = $request->address;
        $account->save();

        return $user;
    }
}
