<?php

namespace App\Model\Admin\Hosting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HostingsFinance extends Model
{
    protected $table = 'hostings_finances';

    protected $fillable = [
        'condition',
        'amount',
        'really_to',
        'hosting_id',
        ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];


    // Relations
    public function hosting(){
        return $this->belongsTo(Hosting::class);
    }

}
