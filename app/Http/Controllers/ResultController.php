<?php

namespace App\Http\Controllers;

use App\User;
use App\Nominations;
use App\Explanations;
use App\Quarter;
use App\Vote;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ResultController extends Controller
{
    private $quarter;

    public function __construct()
    {
        $this->middleware('auth');
        $this->quarter = Quarter::where('active', 1)->pluck('id')->first();
    }

    /**
     * Controller function for /results
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $valueCreatorNominations = Vote::select(\DB::raw('id, user_id, nominee, count(nominee) as vote'))
                                ->where('category', 1)
                                ->where('quarter', $this->quarter)
                                ->whereRaw('year(created_at)', now()->year)
                                ->orderBy('vote', 'desc')
                                ->groupBy('nominee')
                                ->get();
        $peopleDeveloperNominations = Vote::select(\DB::raw('id, user_id, nominee, count(nominee) as vote'))
                                ->where('category', 2)
                                ->where('quarter', $this->quarter)
                                ->whereRaw('year(created_at)', now()->year)
                                ->orderBy('vote', 'desc')
                                ->groupBy('nominee')
                                ->get();
        $businessOperatorNominations = Vote::select(\DB::raw('id, user_id, nominee, count(nominee) as vote'))
                                ->where('category', 3)
                                ->where('quarter', $this->quarter)
                                ->whereRaw('year(created_at)', now()->year)
                                ->orderBy('vote', 'desc')
                                ->groupBy('nominee')
                                ->get();

        $valueCreatorExplanations = self::getExplanation(1);
        $valueCreatorExplanations = self::sortExplanationToUsers($valueCreatorExplanations);
        $peopleDeveloperExplanations = self::getExplanation(2);
        $peopleDeveloperExplanations = self::sortExplanationToUsers($peopleDeveloperExplanations);
        $businessOperatorExplanations = self::getExplanation(3);
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
            $valueCreatorNominations = Vote::select(\DB::raw('id, nominee, count(nominee) as vote'))
                                    ->where('category', 1)
                                    ->where('quarter', $this->quarter)
                                    ->whereRaw('year(created_at)', now()->year)
                                    ->orderBy('vote', 'desc')
                                    ->groupBy('nominee')
                                    ->take(1)
                                    ->get();
            $peopleDeveloperNominations = Vote::select(\DB::raw('id, nominee, count(nominee) as vote'))
                                    ->where('category', 2)
                                    ->where('quarter', $this->quarter)
                                    ->whereRaw('year(created_at)', now()->year)
                                    ->orderBy('vote', 'desc')
                                    ->groupBy('nominee')
                                    ->take(1)
                                    ->get();
            $businessOperatorNominations = Vote::select(\DB::raw('id, nominee, count(nominee) as vote'))
                                    ->where('category', 3)
                                    ->where('quarter', $this->quarter)
                                    ->whereRaw('year(created_at)', now()->year)
                                    ->orderBy('vote', 'desc')
                                    ->groupBy('nominee')
                                    ->take(1)
                                    ->get();
            $valueCreatorExplanations = self::getExplanation(1);
            $valueCreatorExplanations = self::sortExplanationToUsers($valueCreatorExplanations);
            $peopleDeveloperExplanations = self::getExplanation(2);
            $peopleDeveloperExplanations = self::sortExplanationToUsers($peopleDeveloperExplanations);
            $businessOperatorExplanations = self::getExplanation(3);
            $businessOperatorExplanations = self::sortExplanationToUsers($businessOperatorExplanations);

            $valueCreatorTie = self::nomineeTieBreaker(1);
            $valueCreatorTie = count($valueCreatorTie) >= 2;
            $peopleDeveloperTie = self::nomineeTieBreaker(2);
            $peopleDeveloperTie = count($peopleDeveloperTie) >= 2;
            // dd($valueCreatorTie);
            $businessOperatorTie = self::nomineeTieBreaker(3);
            $businessOperatorTie = count($businessOperatorTie) >= 2;

            return view('result', compact('users', 'valueCreatorNominations', 'peopleDeveloperNominations', 'businessOperatorNominations', 'valueCreatorExplanations', 'peopleDeveloperExplanations', 'businessOperatorExplanations', 'valueCreatorTie', 'peopleDeveloperTie', 'businessOperatorTie'));
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
        return $result;
    }

    private function getExplanation($category)
    {
        return DB::select('select * from nominations left join explanations on nominations.id = explanations.nomination_id where year(nominations.created_at) = ? and category = ? and quarter = ? and explanation is not null', [now()->year, $category, $this->quarter]);
    }

    private function nomineeTieBreaker(int $category)
    {
        return DB::select('select id, nominee, count(*) as count from votes where quarter = ? and YEAR(created_at) = ? and category = ? group by nominee having count = (select max(count) from (select count(*) as count from votes where quarter = ? and year(created_at) = ? and category = ? group by nominee ) as count)', [$this->quarter, now()->year, $category, $this->quarter, now()->year, $category]);
    }
}
