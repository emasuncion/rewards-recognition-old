<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nominate extends Model
{
    protected $table = 'nomination';

    public function isOpen()
    {
        $data = $this::first();
        return $data->isVotingOpen;
    }
}
