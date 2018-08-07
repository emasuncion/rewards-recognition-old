<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    public $timestamps = false;

    const VOTED = 1;

    protected $fillable = [
        'name',
        'voted',
    ];

    public function didVote()
    {
        $data = $this::all()->where('name', auth()->user()->name)->pluck('voted')[0];
        return $data === self::VOTED;
    }
}
