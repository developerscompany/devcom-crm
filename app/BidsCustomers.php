<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BidsCustomers extends Model
{
    protected $fillable = [
        'name',
        'country',
        'info',
        'status'
    ];
}
