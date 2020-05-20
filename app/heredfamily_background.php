<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class heredfamily_background extends Model
{
    protected $table = 'heredfamily_backgrounds';

    protected $guarded = [];

    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }
}
