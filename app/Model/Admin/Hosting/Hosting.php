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
        'currency'
    ];





    //appends
    public function getAmountAllAttribute()
    {
        if(Auth::user()->currency()){

            return $this->conditions()->sum('amount') * Auth::user()->currency()->first()->coeff;
        }


    }
    public function getAmountAllYearAttribute()
    {

        if(Auth::user()->currency()) {

            return $this->conditions()->sum('amount_year') * Auth::user()->currency()->first()->coeff;
        }
    }
    public function getCurrencyAttribute()
    {
        if(Auth::user()->currency()) {


            return Auth::user()->currency()->first();

        }
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
