<?php

namespace App\Model\Admin\Hosting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Hosting extends Model
{
    protected $table = 'hostings';

    protected $fillable = [
        'name',
        'last_name',
        'second_name',
        'phone',
    ];

    protected $appends = [
        'amount_all',
    ];





    //appends
    public function getAmountAllAttribute()
    {


        return $this->conditions()->sum('amount');
    }




    //relations
    public function conditions(){

        return $this->hasMany(HostingsCondition::class, 'hosting_id', 'id');
    }

    public function comments(){

        return $this->hasMany(HostingsComment::class, 'hosting_id', 'id')->where('user_id', Auth::id());
    }
}
