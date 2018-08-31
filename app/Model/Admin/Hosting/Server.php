<?php

namespace App\Model\Admin\Hosting;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $table = 'servers';

    protected $fillable = [
        'name',
        'amount_month',
        'amount_year',
    ];
}
