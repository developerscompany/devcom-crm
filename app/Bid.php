<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $fillable = [
        'user_id',
        'customer',
        'date',
        'agent',
        'source',
        'link',
        'niche',
        'current',
        'description',
        'timing',
        'budget',
        'response',
        'status',
        'execut',
        'comment'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
