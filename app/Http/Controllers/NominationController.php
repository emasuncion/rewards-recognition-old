<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Nominations;
use App\Quarter;
use App\Explanations;

class NominationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->employee = new User;
        $this->nomination = new Nominations;
    }

    public function index()
    {
        $users = User::all();
        $quarter = Quarter::where('active', 1)->pluck('id')->first();
        $doneValueCreator = Nominations::where('user_id', auth()->user()->id)
                            ->where('category', 1)
                            ->where('quarter', $quarter)
                            ->where('nominee', '!=', '')
                            ->whereRaw('year(created_at)', now()->year)
                            ->first();
                            // dd(empty($doneValueCreator) );
        $doneValueCreator = empty($doneValueCreator) ? 1 : 0;
        $donePeopleDeveloper = Nominations::where('user_id', auth()->user()->id)
                            ->where('category', 2)
                            ->where('quarter', $quarter)
                            ->where('nominee', '!=', '')
                            ->whereRaw('year(created_at)', now()->year)
                            ->first();
        $donePeopleDeveloper = empty($donePeopleDeveloper) ? 1 : 0;
        $doneBusinessOperator = Nominations::where('user_id', auth()->user()->id)
                            ->where('category', 3)
                            ->where('quarter', $quarter)
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

    public function viewVoters()
    {
        $quarter = Quarter::where('active', 1)->pluck('id')->first();
        $voted = User::select('*')
                    ->leftJoin('nominations', 'nominations.user_id', '=', 'users.id')
                    ->where(function ($query) {
                        $query->where('category', 1)
                        ->orWhere('category', 2)
                        ->orWhere('category', 3);
                    })
                    ->where('quarter', $quarter)
                    ->whereRaw('year(nominations.created_at)', now()->year)
                    ->groupBy('users.id')
                    ->havingRaw('count(users.id) = 3')
                    ->get(['users.*']);
        $notVoted = User::select('*')
                    ->leftJoin('nominations', 'nominations.user_id', '=', 'users.id')
                    ->whereNull('nominations.user_id')
                    ->orWhere(function ($query) {
                        $query->where('category', 1)
                        ->orWhere('category', 2)
                        ->orWhere('category', 3);
                    })
                    ->where('quarter', $quarter)
                    ->whereRaw('year(nominations.created_at)', now()->year)
                    ->groupBy('users.id')
                    ->havingRaw('count(users.id) != 3')
                    ->get();
        return view('voters', compact('voted', 'notVoted'));
    }

    public function submitVote(Request $request)
    {
        $quarter = Quarter::where('active', 1)->pluck('id')->first();
        if ($request->nominee_value_creator) {
            $nominee = Nominations::create([
                'user_id' => auth()->user()->id,
                'nominee' => $request->nominee_value_creator,
                'category' => 1,
                'quarter' => $quarter
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
                'quarter' => $quarter,
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
                'quarter' => $quarter,
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

    public function vote()
    {
        $users = User::all();
        $quarter = Quarter::where('active', 1)->pluck('id')->first();
        $valueCreatorNominations = Nominations::select(\DB::raw('id, nominee, count(nominee) as vote'))
                                ->where('category', 1)
                                ->where('quarter', $quarter)
                                ->whereRaw('year(created_at)', now()->year)
                                ->orderBy('vote', 'desc')
                                ->groupBy('nominee')
                                ->get();
        $peopleDeveloperNominations = Nominations::select(\DB::raw('id, nominee, count(nominee) as vote'))
                                ->where('category', 2)
                                ->where('quarter', $quarter)
                                ->whereRaw('year(created_at)', now()->year)
                                ->orderBy('vote', 'desc')
                                ->groupBy('nominee')
                                ->get();
        $businessOperatorNominations = Nominations::select(\DB::raw('id, nominee, count(nominee) as vote'))
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

        $doneValueCreator = $this->voteDoneValueCreator();
        $donePeopleDeveloper = $this->voteDonePeopleDeveloper();
        $doneBusinessOperator = $this->voteDoneBusinessOperator();

        return view('vote', compact('users', 'valueCreatorNominations', 'peopleDeveloperNominations', 'businessOperatorNominations', 'valueCreatorExplanations', 'peopleDeveloperExplanations', 'businessOperatorExplanations', 'doneValueCreator', 'donePeopleDeveloper', 'doneBusinessOperator'));
    }

    public function addVote(Request $request)
    {
        $nominations = new Nominations;
        $quarter = Quarter::where('active', 1)->pluck('id')->first();
        switch($request->position) {
            case 'value-creator':
                $nominations->user_id = auth()->user()->id;
                $nominations->nominee = $request->nominee;
                $nominations->category = 1;
                $nominations->quarter = $quarter;
                $nominations->save();
                break;
            case 'people-developer':
            $nominations->user_id = auth()->user()->id;
                $nominations->nominee = $request->nominee;
                $nominations->category = 2;
                $nominations->quarter = $quarter;
                $nominations->save();
                break;
            case 'business-operator':
                $nominations->user_id = auth()->user()->id;
                $nominations->nominee = $request->nominee;
                $nominations->category = 3;
                $nominations->quarter = $quarter;
                $nominations->save();
                break;
            default:
                break;
        }
        return response()->json([
            'success' => 'true'
        ]);
    }

    public function filterVoters($id)
    {
        $nominations = Nominations::select('category')->where('user_id', $id)
                        ->where('category', 1)
                        ->orWhere('category', 2)
                        ->orWhere('category', 3)
                        ->whereRaw('year(created_at)', now()->year)
                        ->groupBy('category')
                        ->get();
        return count($nominations) === 3;
    }

    public function voteDoneValueCreator()
    {
        $quarter = Quarter::where('active', 1)->pluck('id')->first();
        return Nominations::where('user_id', auth()->user()->id)
                    ->where('category', 1)
                    ->where('quarter', $quarter)
                    ->whereRaw('year(created_at)', now()->year)
                    ->get();
    }

    public function voteDonePeopleDeveloper()
    {
        $quarter = Quarter::where('active', 1)->pluck('id')->first();
        return Nominations::where('user_id', auth()->user()->id)
                    ->where('category', 2)
                    ->where('quarter', $quarter)
                    ->whereRaw('year(created_at)', now()->year)
                    ->get();
    }

    public function voteDoneBusinessOperator()
    {
        $quarter = Quarter::where('active', 1)->pluck('id')->first();
        return Nominations::where('user_id', auth()->user()->id)
                    ->where('category', 3)
                    ->where('quarter', $quarter)
                    ->whereRaw('year(created_at)', now()->year)
                    ->get();
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
