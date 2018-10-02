<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Employee;
use App\Nominations;
use App\Quarter;
use App\VoteStatus;
use App\Vote;

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

    public function isGuest()
    {
        return $this->type === self::GUEST;
    }

    public function voted()
    {
        $quarter = Quarter::where('active', 1)->pluck('id')->first();
        // OLD implementation <1 vote per user>
        // $nominations = Vote::select('category')->where('user_id', auth()->user()->id)
        //                 ->where(function ($query) {
        //                     $query->where('category', 1)
        //                         ->orWhere('category', 2)
        //                         ->orWhere('category', 3);
        //                 })
        //                 ->where('nominee', '!=', '')
        //                 ->where('quarter', $quarter)
        //                 ->groupBy('category')
        //                 ->get();
        // return count($nominations) === 3;

        // <5 votes per user>
        $votes = Vote::selectRaw('count(*) as count')->where('user_id', auth()->user()->id)
                    ->where(function($query) {
                        $query->where('category', 1)
                        ->orWhere('category', 2)
                        ->orWhere('category', 3);
                    })
                    ->whereRaw('nominee is not null')
                    ->where('quarter', $quarter)
                    ->whereRaw('year(created_at)', now()->year)
                    ->get()
                    ->first();
        return $votes->count === 15;
    }

    public function votingOpen()
    {
        return VoteStatus::where('votingOpen', 1)->pluck('votingOpen')->first();
    }

    public function nominationOpen()
    {
        return VoteStatus::where('nominationOpen', 1)->pluck('nominationOpen')->first();
    }

    public function quarterOpen()
    {
        return Quarter::where('active', 1)->pluck('active')->first();
    }

    public function nominations()
    {
        return $this->hasMany('App\Nominations');
    }
}
