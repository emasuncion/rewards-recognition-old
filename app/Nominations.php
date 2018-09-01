<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nominations extends Model
{
    protected $table = 'nominations';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'nominee',
        'category',
        'explanation',
        'quarter',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function explanation() {
        return $this->belongsTo('App\Explanations');
    }
}
