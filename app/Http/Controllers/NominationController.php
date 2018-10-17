<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Nominations;
use App\Quarter;
use App\Vote;
use App\Explanations;
use Illuminate\Support\Facades\DB;

class NominationController extends Controller
{
    private $quarter;

    public function __construct()
    {
        $this->middleware('auth');
        $this->employee = new User;
        $this->nomination = new Nominations;
        $this->quarter = Quarter::where('active', 1)->pluck('id')->first();
    }

    /**
     * Controller for /nominate
     * @return Illuminate\Http\Request
     */
    public function index()
    {
        $users = User::all();
        $doneValueCreator = Vote::where('user_id', auth()->user()->id)
                            ->where('category', 1)
                            ->where('quarter', $this->quarter)
                            ->where('nominee', '!=', '')
                            ->whereRaw('year(created_at)', now()->year)
                            ->first();
        $doneValueCreator = empty($doneValueCreator) ? 1 : 0;
        $donePeopleDeveloper = Vote::where('user_id', auth()->user()->id)
                            ->where('category', 2)
                            ->where('quarter', $this->quarter)
                            ->where('nominee', '!=', '')
                            ->whereRaw('year(created_at)', now()->year)
                            ->first();
        $donePeopleDeveloper = empty($donePeopleDeveloper) ? 1 : 0;
        $doneBusinessOperator = Vote::where('user_id', auth()->user()->id)
                            ->where('category', 3)
                            ->where('quarter', $this->quarter)
                            ->where('nominee', '!=', '')
                            ->whereRaw('year(created_at)', now()->year)
                            ->first();
        $doneBusinessOperator = empty($doneBusinessOperator) ? 1 : 0;
        if (auth()->user()->voted()) {
            return view('alreadyVoted');
        } else {
            return view('nominate', compact('users', 'doneValueCreator', 'donePeopleDeveloper', 'doneBusinessOperator'));
        }
    }

    /**
     * This function shows the users who voted/did not vote.
     * Users who voted are the ones with at least one vote
     * @return [type] [description]
     */
    public function viewVoters()
    {
        $voted = DB::select('select * from users where id in (select user_id from votes where (category = 1 or category = 2 or category = 3) and quarter = ? and year(created_at) = ?)', [$this->quarter, now()->year]);
        $notVoted = DB::select('select * from users where id not in (select user_id from votes where (category = 1 or category = 2 or category = 3) and quarter = ? and year(created_at) = ?)', [$this->quarter, now()->year]);
        return view('voters', compact('voted', 'notVoted'));
    }

    public function submitVote(Request $request)
    {
        if ($request->nominee_value_creator) {
            $nominee = Nominations::create([
                'user_id' => auth()->user()->id,
                'nominee' => $request->nominee_value_creator,
                'category' => 1,
                'quarter' => $this->quarter
            ])->id;
            Explanations::create([
                'nomination_id' => $nominee,
                'explanation' => $request->explanation_value_creator
            ]);
        }

        if ($request->nominee_people_developer) {
            $nominee = Nominations::create([
                'user_id' => auth()->user()->id,
                'nominee' => $request->nominee_people_developer,
                'category' => 2,
                'quarter' => $this->quarter,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ])->id;
            Explanations::create([
                'nomination_id' => $nominee,
                'explanation' => $request->explanation_people_developer
            ]);
        }

        if ($request->nominee_business_operator) {
            $nominee = Nominations::create([
                'user_id' => auth()->user()->id,
                'nominee' => $request->nominee_business_operator,
                'category' => 3,
                'quarter' => $this->quarter,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ])->id;
            Explanations::create([
                'nomination_id' => $nominee,
                'explanation' => $request->explanation_business_operator
            ]);
        }

        if (auth()->user()->isAdmin()) {
            return redirect('admin');
        } else {
            return redirect('home');
        }
    }

    /**
     * Controller function for /vote
     * @return Illuminate\Http\Request
     */
    public function vote()
    {
        $users = User::all();
        $valueCreatorNominations = Nominations::select(\DB::raw('id, nominee, count(nominee) as vote'))
                                ->where('category', 1)
                                ->where('quarter', $this->quarter)
                                ->whereRaw('year(created_at)', now()->year)
                                ->orderBy('nominee')
                                ->groupBy('nominee')
                                ->get();
        $peopleDeveloperNominations = Nominations::select(\DB::raw('id, nominee, count(nominee) as vote'))
                                ->where('category', 2)
                                ->where('quarter', $this->quarter)
                                ->whereRaw('year(created_at)', now()->year)
                                ->orderBy('nominee')
                                ->groupBy('nominee')
                                ->get();
        $businessOperatorNominations = Nominations::select(\DB::raw('id, nominee, count(nominee) as vote'))
                                ->where('category', 3)
                                ->where('quarter', $this->quarter)
                                ->whereRaw('year(created_at)', now()->year)
                                ->orderBy('nominee')
                                ->groupBy('nominee')
                                ->get();
        $valueCreatorExplanations = self::getExplanation(1);
        $valueCreatorExplanations = self::sortExplanationToUsers($valueCreatorExplanations);
        $peopleDeveloperExplanations = self::getExplanation(2);
        $peopleDeveloperExplanations = self::sortExplanationToUsers($peopleDeveloperExplanations);
        $businessOperatorExplanations = self::getExplanation(3);
        $businessOperatorExplanations = self::sortExplanationToUsers($businessOperatorExplanations);

        $doneValueCreator = $this->voteDone(1);
        $donePeopleDeveloper = $this->voteDone(2);
        $doneBusinessOperator = $this->voteDone(3);

        $votedVC = $this->voteDonePeople(1);
        $votedPD = $this->voteDonePeople(2);
        $votedBO = $this->voteDonePeople(3);

        return view('vote', compact('users', 'valueCreatorNominations', 'peopleDeveloperNominations', 'businessOperatorNominations', 'valueCreatorExplanations', 'peopleDeveloperExplanations', 'businessOperatorExplanations', 'doneValueCreator', 'donePeopleDeveloper', 'doneBusinessOperator', 'votedVC', 'votedPD', 'votedBO'));
    }

    public function myNominations()
    {
        $valueCreatorNominations = Nominations::where('user_id', auth()->user()->id)
                                    ->where('category', 1)
                                    ->where('quarter', $this->quarter)
                                    ->whereRaw('year(created_at)', now()->year)
                                    ->orderBy('nominee')
                                    ->groupBy('nominee')
                                    ->get();
        $valueCreatorExplanations = self::getExplanation(1);
        $peopleDeveloperNominations = Nominations::where('user_id', auth()->user()->id)
                                    ->where('category', 2)
                                    ->where('quarter', $this->quarter)
                                    ->whereRaw('year(created_at)', now()->year)
                                    ->orderBy('nominee')
                                    ->groupBy('nominee')
                                    ->get();
        $peopleDeveloperExplanations = self::getExplanation(2);
        $businessOperatorNominations = Nominations::where('user_id', auth()->user()->id)
                                    ->where('category', 3)
                                    ->where('quarter', $this->quarter)
                                    ->whereRaw('year(created_at)', now()->year)
                                    ->orderBy('nominee')
                                    ->groupBy('nominee')
                                    ->get();
        $businessOperatorExplanations = self::getExplanation(3);
        return view('myNominations', compact('valueCreatorNominations', 'peopleDeveloperNominations', 'businessOperatorNominations', 'valueCreatorExplanations', 'peopleDeveloperExplanations', 'businessOperatorExplanations'));
    }

    public function nominations()
    {
        $valueCreatorNominations = Nominations::where('category', 1)
                                    ->where('quarter', $this->quarter)
                                    ->whereRaw('year(created_at)', now()->year)
                                    ->orderBy('nominee')
                                    ->groupBy('nominee')
                                    ->get();
        $valueCreatorExplanations = self::getExplanation(1);
        $peopleDeveloperNominations = Nominations::where('category', 2)
                                    ->where('quarter', $this->quarter)
                                    ->whereRaw('year(created_at)', now()->year)
                                    ->orderBy('nominee')
                                    ->groupBy('nominee')
                                    ->get();
        $peopleDeveloperExplanations = self::getExplanation(2);
        $businessOperatorNominations = Nominations::where('category', 3)
                                    ->where('quarter', $this->quarter)
                                    ->whereRaw('year(created_at)', now()->year)
                                    ->orderBy('nominee')
                                    ->groupBy('nominee')
                                    ->get();
        $businessOperatorExplanations = self::getExplanation(3);
        return view('nominations', compact('valueCreatorNominations', 'peopleDeveloperNominations', 'businessOperatorNominations', 'valueCreatorExplanations', 'peopleDeveloperExplanations', 'businessOperatorExplanations'));
    }

    public function addVote(Request $request)
    {
        $vote = new Vote;
        switch($request->position) {
            case 'value-creator':
                $vote->user_id = auth()->user()->id;
                $vote->nominee = $request->nominee;
                $vote->category = 1;
                $vote->quarter = $this->quarter;
                $vote->save();
                break;
            case 'people-developer':
            $vote->user_id = auth()->user()->id;
                $vote->nominee = $request->nominee;
                $vote->category = 2;
                $vote->quarter = $this->quarter;
                $vote->save();
                break;
            case 'business-operator':
                $vote->user_id = auth()->user()->id;
                $vote->nominee = $request->nominee;
                $vote->category = 3;
                $vote->quarter = $this->quarter;
                $vote->save();
                break;
            default:
                break;
        }
        return response()->json([
            'success' => 'true'
        ]);
    }

    public function voteDone(int $category)
    {
        $vote = Vote::where('user_id', auth()->user()->id)
                    ->where('category', $category)
                    ->where('quarter', $this->quarter)
                    ->whereRaw('year(created_at)', now()->year)
                    ->get();
        return count($vote) >= 3;
    }

    public function voteDonePeople(int $category)
    {
        return DB::select('select distinct nominee from nominations where category = ? and quarter = ? and year(created_at) = ? and nominee not in (select nominee from votes where user_id = ? and category = ? and quarter = ? and year(created_at) = ?)', [$category, $this->quarter, now()->year, auth()->user()->id, $category, $this->quarter, now()->year]);
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
}
