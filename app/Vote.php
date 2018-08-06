<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $table = 'votes';
    public $timestamps = false;

    protected $fillable = [
        'nominee_value_creator',
        'nominee_people_developer',
        'nominee_business_operator',
        'explanation_value_creator',
        'explanation_people_developer',
        'explanation_business_operator',
    ];
}
