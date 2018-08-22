<?php

namespace App\Model\Admin\Hosting;

use Illuminate\Database\Eloquent\Model;

class HostingsFinance extends Model
{
    protected $table = 'hostings_finances';

    protected $fillable = [
        'condition',
        'amount',
        'really_to',
    ];
}
