<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Nominations;

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
        if (auth()->user()->voted()) {
            return view('alreadyVoted');
        } else {
            return view('nominate', compact('users'));
        }
    }

    public function viewVoters()
    {
        $notVoted = User::with('nominations')
                    ->join('nominations', 'nominations.user_id', '=', 'users.id')
                    ->where('category', 1)
                    ->orWhere('category', 2)
                    ->orWhere('category', 3)
                    ->groupBy('users.id')
                    ->get(['users.*']);
        return view('voters', compact('voted', 'notVoted'));
    }

    public function submitVote(Request $request)
    {
        Nominations::Create($request->all());

        User::where('name', auth()->user()->name)
            ->update(['voted' => 1]);

        if (auth()->user()->isAdmin()) {
            return redirect('admin');
        } else {
            return redirect('home');
        }
    }

    public function vote()
    {
        $users = User::all();
        $valueCreatorNominations = Nominations::all()->where('category', 1);
        $peopleDeveloperNominations = Nominations::all()->where('category', 2);
        $businessOperatorNominations = Nominations::all()->where('category', 3);

        return view('vote', compact('users', 'valueCreatorNominations', 'peopleDeveloperNominations', 'businessOperatorNominations'));
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
