<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Employee;
use App\Vote;

class VoteController extends Controller
{
    protected $employee;
    protected $vote;
    /**
     * Create a new Vote controller instance
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->employee = new Employee;
        $this->vote = new Vote;
    }

    /**
     * Show the vote landing page
     * @return Illuminate\Http\Request
     */
    public function index()
    {
        $employees = Employee::all()->where('name', '!=', 'Admin')->where('name', '!=', 'Guest');
        $alreadyVoted = Employee::where('name', auth()->user()->name)->where('voted', 1)->first();
        if ($alreadyVoted) {
            return view('alreadyVoted');
        } else {
            return view('vote', ['employees' => $employees]);
        }
    }

    public function submitVote(Request $request)
    {
        $validateData = $request->validate([
            'nominee_value_creator' => 'required',
            'nominee_people_developer' => 'required',
            'nominee_business_operator' => 'required',
            'explanation_value_creator' => 'required',
            'explanation_people_developer' => 'required',
            'explanation_business_operator' => 'required',
        ]);

        Vote::Create($request->all());

        Employee::where('name', auth()->user()->name)
            ->update(['voted' => 1]);

        return redirect('home');
    }

    public function viewVoters()
    {
        $voted = Employee::all()->where('voted', 1);
        $notVotedYet = Employee::all()->where('voted', 0);
        return view('voters', ['voted' => $voted, 'notVotedYet' => $notVotedYet]);
    }
}
