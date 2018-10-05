<?php

namespace App\Model\Admin\Hosting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\ConditionType;
use Illuminate\Support\Facades\Auth;

class HostingsFinance extends Model
{
    protected $table = 'hostings_finances';

    protected $fillable = [
        'condition',
        'amount',
        'really_to',
        'hosting_id',
        'created_at',
        ];

    protected $appends = ['currency'];


    public function getAmountAttribute(){
        if(Auth::user()->currency()->first()) {


            return $this->attributes['amount'] * Auth::user()->currency()->first()->coeff;
        }
    }

    public function getCurrencyAttribute() {
        if(Auth::user()->currency()->first()) {

            return Auth::user()->currency()->first();
        }

    }




    // Relations
    public function hosting(){
        return $this->belongsTo(Hosting::class);
    }

    public function conds(){

        return $this->belongsTo(ConditionType::class, 'condition', 'name');
    }

}
