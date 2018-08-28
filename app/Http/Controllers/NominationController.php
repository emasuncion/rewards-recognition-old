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
        $doneValueCreator = Nominations::where('user_id', auth()->user()->id)
                            ->where('category', 1)
                            ->where('nominee', '!=', '')
                            ->first();
                            // dd(empty($doneValueCreator) );
        $doneValueCreator = empty($doneValueCreator) ? 1 : 0;
        $donePeopleDeveloper = Nominations::where('user_id', auth()->user()->id)
                            ->where('category', 2)
                            ->where('nominee', '!=', '')
                            ->first();
        $donePeopleDeveloper = empty($donePeopleDeveloper) ? 1 : 0;
        $doneBusinessOperator = Nominations::where('user_id', auth()->user()->id)
                            ->where('category', 3)
                            ->where('nominee', '!=', '')
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
        $voted = User::with('nominations')
                    ->join('nominations', 'nominations.user_id', '=', 'users.id')
                    ->where('category', 1)
                    ->orWhere('category', 2)
                    ->orWhere('category', 3)
                    ->groupBy('users.id')
                    ->get(['users.*']);
        $notVoted = User::select('*')
                    ->leftJoin('nominations', 'nominations.user_id', '=', 'users.id')
                    ->whereRaw('nominations.user_id is null')
                    ->get();
        return view('voters', compact('voted', 'notVoted'));
    }

    public function submitVote(Request $request)
    {
        $quarter = Quarter::where('active', 1)->pluck('id')->first();
        Nominations::insert([
            [
                'user_id' => auth()->user()->id,
                'nominee' => $request->nominee_value_creator,
                'category' => 1,
                'explanation' => $request->explanation_value_creator,
                'quarter' => $quarter,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => auth()->user()->id,
                'nominee' => $request->nominee_people_developer,
                'category' => 2,
                'explanation' => $request->explanation_people_developer,
                'quarter' => $quarter,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => auth()->user()->id,
                'nominee' => $request->nominee_business_operator,
                'category' => 3,
                'explanation' => $request->explanation_business_operator,
                'quarter' => $quarter,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

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
        return view('vote', compact('users', 'valueCreatorNominations', 'peopleDeveloperNominations', 'businessOperatorNominations', 'valueCreatorExplanations', 'peopleDeveloperExplanations', 'businessOperatorExplanations'));
    }

    public function addVote(Request $request)
    {
        $vote = new Nominations;
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
        Employee::where('name', auth()->user()->name)
            ->update(['voted' => 1]);
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
                        ->groupBy('category')
                        ->get();
        return count($nominations) === 3;
    }
}
