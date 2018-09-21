<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminTransaction extends Model
{
    protected $fillable = [
        'date',
        'summ',
        'description',
        'project',
        'agent_id',
        'requisite_id',
    ];
}
