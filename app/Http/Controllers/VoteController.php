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
            return view('nominate', ['employees' => $employees]);
        }
    }

    public function submitVote(Request $request)
    {
        Vote::Create($request->all());

        Employee::where('name', auth()->user()->name)
            ->update(['voted' => 1]);

        if (auth()->user()->isAdmin()) {
            return redirect('admin');
        } else {
            return redirect('home');
        }
    }

    public function viewVoters()
    {
        $voted = Employee::all()->where('voted', 1);
        $notVotedYet = Employee::all()->where('voted', 0);
        return view('voters', ['voted' => $voted, 'notVotedYet' => $notVotedYet]);
    }

    public function vote()
    {
        $employees = Employee::all()->where('name', '!=', 'Admin')->where('name', '!=', 'Guest')->where('name', '!=', '');
        // Get the votes
        $valueCreatorVotes = DB::table('votes')->select(DB::raw('distinct(nominee_value_creator) as nominee, count(nominee_value_creator) as vote'))
                                ->where('nominee_value_creator', '!=', '')
                                ->groupBy('nominee')
                                ->orderBy('nominee')
                                ->get();
        $peopleDeveloperVotes = DB::table('votes')->select(DB::raw('distinct(nominee_people_developer) as nominee, count(nominee_people_developer) as vote'))
                                ->where('nominee_people_developer', '!=', '')
                                ->groupBy('nominee')
                                ->orderBy('nominee')
                                ->get();
        $businessOperatorVotes = DB::table('votes')->select(DB::raw('distinct(nominee_business_operator) as nominee, count(nominee_business_operator) as vote'))
                                ->where('nominee_business_operator', '!=', '')
                                ->groupBy('nominee')
                                ->orderBy('nominee')
                                ->get();
        // Get the explanations
        $valueCreatorExplanations = DB::table('votes')->select(DB::raw('nominee_value_creator as nominee, explanation_value_creator'))
                                ->where('explanation_value_creator', '!=', '')
                                ->orderBy('nominee', 'asc')
                                ->get();
        $peopleDeveloperExplanations = DB::table('votes')->select(DB::raw('nominee_people_developer as nominee, explanation_people_developer'))
                                ->where('explanation_people_developer', '!=', '')
                                ->orderBy('nominee', 'asc')
                                ->get();
        $businessOperatorExplanations = DB::table('votes')->select(DB::raw('nominee_business_operator as nominee, explanation_business_operator'))
                                ->where('explanation_business_operator', '!=', '')
                                ->orderBy('nominee', 'asc')
                                ->get();

        return view('vote', [
            'employees' => $employees,
            'valueCreatorVotes' => $valueCreatorVotes,
            'peopleDeveloperVotes' => $peopleDeveloperVotes,
            'businessOperatorVotes' => $businessOperatorVotes,
            'valueCreatorExplanations' => $valueCreatorExplanations,
            'peopleDeveloperExplanations' => $peopleDeveloperExplanations,
            'businessOperatorExplanations' => $businessOperatorExplanations
        ]);
    }

    public function addVote(Request $request)
    {
        $vote = new Vote;
        switch($request->position) {
            case 'value-creator':
                $vote->nominee_value_creator = $request->nominee;
                $vote->explanation_value_creator = $request->data;
                $vote->save();
                break;
            case 'people-developer':
                $vote->nominee_people_developer = $request->nominee;
                $vote->explanation_people_developer = $request->data;
                $vote->save();
                break;
            case 'business-operator':
                $vote->nominee_business_operator = $request->nominee;
                $vote->explanation_business_operator = $request->data;
                $vote->save();
                break;
            default:
                break;
        }
        return response()->json([
            'success' => 'true'
        ]);
    }
}
