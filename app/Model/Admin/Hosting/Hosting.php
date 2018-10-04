<?php

namespace App\Model\Admin\Hosting;

use App\ConditionType;
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
        'site',
    ];

    protected $appends = [
        'amount_all',
        'amount_all_year',
    ];





    //appends
    public function getAmountAllAttribute()
    {


        return $this->conditions()->sum('amount');
    }
    public function getAmountAllYearAttribute()
    {


        return $this->conditions()->sum('amount_year');
    }



    //relations
    public function conditions(){

        return $this->hasMany(HostingsCondition::class, 'hosting_id', 'id');
    }

    public function comments(){

        return $this->hasMany(HostingsComment::class, 'hosting_id', 'id')->where('user_id', Auth::id());
    }

    public function finances(){

        return $this->hasMany(HostingsFinance::class, 'hosting_id', 'id');

    }

    public function latestFinance(){

        return $this->hasOne(HostingsFinance::class, 'hosting_id', 'id')->where('condition','=','site')->latest('really_to');
    }



}
