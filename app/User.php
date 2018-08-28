<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Employee;
use App\Nominations;
use App\Quarter;

class User extends Authenticatable
{
    use Notifiable;

    const ADMIN = 1;
    const NOMINEE = 2;
    const GUEST = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
        return $this->type === self::ADMIN;
    }

    public function voted()
    {
        $nominations = Nominations::select('category')->where('user_id', auth()->user()->id)
                        ->where('category', 1)
                        ->orWhere('category', 2)
                        ->orWhere('category', 3)
                        ->where('nominee', '!=', '')
                        ->groupBy('category')
                        ->get();
        return count($nominations) === 3;
    }

    public function votingOpen()
    {
        return Quarter::all()->where('active', 1)->first();
    }

    public function nominations()
    {
        return $this->hasMany('App\Nominations');
    }
}
