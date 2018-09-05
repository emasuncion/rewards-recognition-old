<?php

namespace App\Http\Controllers;

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
     * Controller function for /results
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $quarter = Quarter::where('active', 1)->pluck('id')->first();
        $valueCreatorNominations = Nominations::select(\DB::raw('id, user_id, nominee, count(nominee) as vote'))
                                ->where('category', 1)
                                ->where('quarter', $quarter)
                                ->whereRaw('year(created_at)', now()->year)
                                ->orderBy('vote', 'desc')
                                ->groupBy('nominee')
                                ->get();
        $peopleDeveloperNominations = Nominations::select(\DB::raw('id, user_id, nominee, count(nominee) as vote'))
                                ->where('category', 2)
                                ->where('quarter', $quarter)
                                ->whereRaw('year(created_at)', now()->year)
                                ->orderBy('vote', 'desc')
                                ->groupBy('nominee')
                                ->get();
        $businessOperatorNominations = Nominations::select(\DB::raw('id, user_id, nominee, count(nominee) as vote'))
                                ->where('category', 3)
                                ->where('quarter', $quarter)
                                ->whereRaw('year(created_at)', now()->year)
                                ->orderBy('vote', 'desc')
                                ->groupBy('nominee')
                                ->get();

        $valueCreatorExplanations = DB::select('select * from nominations left join explanations on nominations.id = explanations.nomination_id where year(nominations.created_at) = ? and category = 1', [now()->year]);
        $valueCreatorExplanations = self::sortExplanationToUsers($valueCreatorExplanations);
        $peopleDeveloperExplanations = DB::select('select * from nominations left join explanations on nominations.id = explanations.nomination_id where year(nominations.created_at) = ? and category = 2', [now()->year]);
        $peopleDeveloperExplanations = self::sortExplanationToUsers($peopleDeveloperExplanations);
        $businessOperatorExplanations = DB::select('select * from nominations left join explanations on nominations.id = explanations.nomination_id where year(nominations.created_at) = ? and category = 3', [now()->year]);
        $businessOperatorExplanations = self::sortExplanationToUsers($businessOperatorExplanations);

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
                                    ->whereRaw('year(created_at)', now()->year)
                                    ->orderBy('vote', 'desc')
                                    ->groupBy('nominee')
                                    ->take(1)
                                    ->get();
            $peopleDeveloperNominations = Nominations::select(\DB::raw('id, nominee, count(nominee) as vote'))
                                    ->where('category', 2)
                                    ->where('quarter', $quarter)
                                    ->whereRaw('year(created_at)', now()->year)
                                    ->orderBy('vote', 'desc')
                                    ->groupBy('nominee')
                                    ->take(1)
                                    ->get();
            $businessOperatorNominations = Nominations::select(\DB::raw('id, nominee, count(nominee) as vote'))
                                    ->where('category', 3)
                                    ->where('quarter', $quarter)
                                    ->whereRaw('year(created_at)', now()->year)
                                    ->orderBy('vote', 'desc')
                                    ->groupBy('nominee')
                                    ->take(1)
                                    ->get();
            $valueCreatorExplanations = DB::select('select * from nominations left join explanations on nominations.id = explanations.nomination_id where year(nominations.created_at) = ? and category = 1', [now()->year]);
            $valueCreatorExplanations = self::sortExplanationToUsers($valueCreatorExplanations);
            $peopleDeveloperExplanations = DB::select('select * from nominations left join explanations on nominations.id = explanations.nomination_id where year(nominations.created_at) = ? and category = 2', [now()->year]);
            $peopleDeveloperExplanations = self::sortExplanationToUsers($peopleDeveloperExplanations);
            $businessOperatorExplanations = DB::select('select * from nominations left join explanations on nominations.id = explanations.nomination_id where year(nominations.created_at) = ? and category = 3', [now()->year]);
            $businessOperatorExplanations = self::sortExplanationToUsers($businessOperatorExplanations);

            return view('result', compact('users', 'valueCreatorNominations', 'peopleDeveloperNominations', 'businessOperatorNominations', 'valueCreatorExplanations', 'peopleDeveloperExplanations', 'businessOperatorExplanations'));
        }
    }

    private function sortExplanationToUsers($category) {
        $result = array();
        foreach($category as $value)
        {
            if(!isset($result[$value->nominee]))
            {
                 $result[$value->nominee] = array();
            }

            $result[$value->nominee][] = $value->explanation;
        }
        // dd($result);
        return $result;
    }
}
