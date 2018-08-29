<?php

namespace App\Model\Admin\Hosting;

use App\User;
use Illuminate\Database\Eloquent\Model;

class HostingsComment extends Model
{
    protected $table = 'hostings_comments';

    protected $fillable = [
        'hosting_id',
        'user_id',
        'message'
    ];





    // Relations


    public function user(){

        return $this->belongsTo(User::class);
    }
}
