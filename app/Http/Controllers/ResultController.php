<?php

namespace App\Http\Controllers;

use App\Vote;
use App\User;
use App\Nominations;
use App\Explanations;
use App\Quarter;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ResultController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();
        $quarter = Quarter::where('active', 1)->pluck('id')->first();
        $valueCreatorNominations = Nominations::select(\DB::raw('id, nominee, count(nominee) as vote'))
                                ->where('category', 1)
                                ->where('quarter', $quarter)
                                ->orderBy('vote', 'desc')
                                ->groupBy('nominee')
                                ->get();
        $peopleDeveloperNominations = Nominations::select(\DB::raw('id, nominee, count(nominee) as vote'))
                                ->where('category', 2)
                                ->where('quarter', $quarter)
                                ->orderBy('vote', 'desc')
                                ->groupBy('nominee')
                                ->get();
        $businessOperatorNominations = Nominations::select(\DB::raw('id, nominee, count(nominee) as vote'))
                                ->where('category', 3)
                                ->where('quarter', $quarter)
                                ->orderBy('vote', 'desc')
                                ->groupBy('nominee')
                                ->get();

        $valueCreatorExplanations = Explanations::all()->where('category', 1);
        $peopleDeveloperExplanations = Explanations::all()->where('category', 2);
        $businessOperatorExplanations = Explanations::all()->where('category', 3);

        return view('result', compact('users', 'valueCreatorNominations', 'peopleDeveloperNominations', 'businessOperatorNominations', 'valueCreatorExplanations', 'peopleDeveloperExplanations', 'businessOperatorExplanations'));
    }

    public function submitted()
    {
        if (auth()->user()->votingOpen()) {
            return view('errorResult');
        } else {
            $employees = Employee::all()->where('name', '!=', 'Admin')->where('name', '!=', 'Guest');
            // Get the votes
            $valueCreatorVotes = DB::table('votes')->select(DB::raw('distinct(nominee_value_creator) as nominee, count(nominee_value_creator) as vote'))
                                ->where('nominee_value_creator', '!=', '')
                                ->groupBy('nominee')
                                ->orderBy('vote', 'desc')
                                ->take(1)
                                ->get();
            $peopleDeveloperVotes = DB::table('votes')->select(DB::raw('distinct(nominee_people_developer) as nominee, count(nominee_people_developer) as vote'))
                                ->where('nominee_people_developer', '!=', '')
                                ->groupBy('nominee')
                                ->orderBy('vote', 'desc')
                                ->take(1)
                                ->get();
            $businessOperatorVotes = DB::table('votes')->select(DB::raw('distinct(nominee_business_operator) as nominee, count(nominee_business_operator) as vote'))
                                ->where('nominee_business_operator', '!=', '')
                                ->groupBy('nominee')
                                ->orderBy('vote', 'desc')
                                ->take(1)
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
    }
}
