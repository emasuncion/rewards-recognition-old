<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quarter extends Model
{
    protected $table = 'quarter';
    public $timestamps = false;

    protected $fillable = [
        'active'
    ];
}
