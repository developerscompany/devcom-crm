<?php

namespace App\Model\Admin\Hosting;

use Illuminate\Database\Eloquent\Model;

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
}
