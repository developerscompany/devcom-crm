<?php

namespace App\Model\Admin\Hosting;

use Illuminate\Database\Eloquent\Model;

class HostingsCondition extends Model
{
    protected $table = 'hostings_conditions';

    protected $fillable = [
        'hosting_id',
        'condition',
        'amount',
        'created_at',
        'updated_at',
    ];



}
