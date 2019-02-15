<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rest extends Model
{
    public function work()
    {
        return $this->belongsTo('App\Work');
    }
}
