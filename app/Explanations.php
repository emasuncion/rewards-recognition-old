<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Explanations extends Model
{
    protected $table = 'explanations';
    public $timestamps = true;

    protected $fillable = [
        'nomination_id',
        'explanation'
    ];

    public function nominations()
    {
        return $this->belongsTo('App\Nominations');
    }
}
