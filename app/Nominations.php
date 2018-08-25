<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nominations extends Model
{
    protected $table = 'nominations';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
