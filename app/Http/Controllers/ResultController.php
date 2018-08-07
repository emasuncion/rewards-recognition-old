<?php

namespace App\Http\Controllers;

use App\Vote;
use App\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->user()->isAdmin()) {
            $employees = Employee::all()->where('name', '!=', 'Admin')->where('name', '!=', 'Guest');
            // Get the votes
            $valueCreatorVotes = DB::table('votes')->select(DB::raw('distinct(nominee_value_creator) as nominee, count(nominee_value_creator) as vote'))->groupBy('nominee')->orderBy('vote', 'desc')->get();
            $peopleDeveloperVotes = DB::table('votes')->select(DB::raw('distinct(nominee_people_developer) as nominee, count(nominee_people_developer) as vote'))->groupBy('nominee')->orderBy('vote', 'desc')->get();
            $businessOperatorVotes = DB::table('votes')->select(DB::raw('distinct(nominee_business_operator) as nominee, count(nominee_business_operator) as vote'))->groupBy('nominee')->orderBy('vote', 'desc')->get();
            // Get the explanations
            $valueCreatorExplanations = DB::table('votes')->select(DB::raw('nominee_value_creator as nominee, explanation_value_creator'))->orderBy('nominee', 'asc')->get();
            $peopleDeveloperExplanations = DB::table('votes')->select(DB::raw('nominee_people_developer as nominee, explanation_people_developer'))->orderBy('nominee', 'asc')->get();
            $businessOperatorExplanations = DB::table('votes')->select(DB::raw('nominee_business_operator as nominee, explanation_business_operator'))->orderBy('nominee', 'asc')->get();

            return view('result', [
                'employees' => $employees,
                'valueCreatorVotes' => $valueCreatorVotes,
                'peopleDeveloperVotes' => $peopleDeveloperVotes,
                'businessOperatorVotes' => $businessOperatorVotes,
                'valueCreatorExplanations' => $valueCreatorExplanations,
                'peopleDeveloperExplanations' => $peopleDeveloperExplanations,
                'businessOperatorExplanations' => $businessOperatorExplanations
            ]);
        }
        return redirect('home');
    }
}
