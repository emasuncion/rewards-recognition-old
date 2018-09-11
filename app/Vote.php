<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $table = 'votes';
    protected $fillable = [
        'user_id',
        'nominee',
        'category',
        'quarter',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
