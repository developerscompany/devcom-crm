<?php

namespace App\Model\Admin\Hosting;

use Illuminate\Database\Eloquent\Model;

class HostingsCondition extends Model
{
    protected $table = 'hostings_conditions';

    protected $fillable = [
        'id',
        'hosting_id',
        'condition',
        'amount',
        'amount_year',
        'created_at',
        'updated_at',
    ];




    // Relations

    public function finance(){
        $cond = $this->getAttribute('condition');
        return $this->belongsTo(HostingsFinance::class, 'condition', 'condition')
            ->orderBy('really_to', 'asc');
    }




}
