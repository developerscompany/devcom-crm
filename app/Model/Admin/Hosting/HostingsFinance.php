<?php

namespace App\Model\Admin\Hosting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\ConditionType;

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



    // Relations
    public function hosting(){
        return $this->belongsTo(Hosting::class);
    }

    public function conds(){

        return $this->belongsTo(ConditionType::class, 'condition', 'name');
    }

}
