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

    /**
     * Controller function for /results/partial
     * @return \Illuminate\Http\Response
     */
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
        $valueCreatorExplanations = Explanations::all();
        $peopleDeveloperExplanations = Explanations::all();
        $businessOperatorExplanations = Explanations::all();

        return view('result', compact('users', 'valueCreatorNominations', 'peopleDeveloperNominations', 'businessOperatorNominations', 'valueCreatorExplanations', 'peopleDeveloperExplanations', 'businessOperatorExplanations'));
    }

    /**
     * Controller function for /results/submitted
     * @return \Illuminate\Http\Response
     */
    public function submitted()
    {
        if (auth()->user()->votingOpen()) {
            return view('errorResult');
        } else {
            $users = User::all();
            $quarter = Quarter::where('active', 1)->pluck('id')->first();
            $valueCreatorNominations = Nominations::select(\DB::raw('id, nominee, count(nominee) as vote'))
                                    ->where('category', 1)
                                    ->where('quarter', $quarter)
                                    ->orderBy('vote', 'desc')
                                    ->groupBy('nominee')
                                    ->take(1);
            $peopleDeveloperNominations = Nominations::select(\DB::raw('id, nominee, count(nominee) as vote'))
                                    ->where('category', 2)
                                    ->where('quarter', $quarter)
                                    ->orderBy('vote', 'desc')
                                    ->groupBy('nominee')
                                    ->take(1);
            $businessOperatorNominations = Nominations::select(\DB::raw('id, nominee, count(nominee) as vote'))
                                    ->where('category', 3)
                                    ->where('quarter', $quarter)
                                    ->orderBy('vote', 'desc')
                                    ->groupBy('nominee')
                                    ->take(1);
            $valueCreatorExplanations = Explanations::all();
            $peopleDeveloperExplanations = Explanations::all();
            $businessOperatorExplanations = Explanations::all();

            return view('result', compact('users', 'valueCreatorNominations', 'peopleDeveloperNominations', 'businessOperatorNominations', 'valueCreatorExplanations', 'peopleDeveloperExplanations', 'businessOperatorExplanations'));
        }
    }
}
