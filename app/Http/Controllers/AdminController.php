<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Nominate;
use App\User;
use App\Employee;
use App\Quarter;
use App\VoteStatus;
use App\Explanations;

class AdminController extends Controller
{
    private $quarter;
    /**
     * Create a new Admin controller instance
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->quarter = Quarter::where('active', 1)->pluck('id')->first();
    }

    /**
     * Show the Admin landing page
     * @return Illuminate\Http\Request
     */
    public function index()
    {
        return view('adminBody');
    }

    public function settings()
    {
        $users = User::where('active', 1)
                    ->orderBy('first_name', 'asc')
                    ->paginate(5);
        $quarter = Quarter::all();
        $voting = VoteStatus::first();
        return view('settings', compact('users', 'quarter', 'voting'));
    }

    public function changeRole(Request $request)
    {
        // Fallback user type is 2
        $isAdmin = $request->isAdmin === 'true' ? 1 : 2;
        User::where('id', (integer) $request->userId)->update(['type' => $isAdmin]);
        return response()->json([
            'success' => 'true'
        ]);
    }

    public function changeGuest(Request $request)
    {
        // Fallback user type is 2
        $isGuest = $request->active === 'true' ? 3 : 2;
        User::where('id', (integer) $request->userId)->update(['type' => $isGuest]);
        return response()->json([
            'success' => 'true'
        ]);
    }

    public function addMember(Request $request)
    {
         $this->validate($request, [
            'firstName' => 'required|string|max:32',
            'lastName' => 'required|string|max:32',
            'username' => 'required|string|max:32',
            'email' => 'required|string|email|indisposable|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            // 'password' => 'required|string|min:6|confirmed|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
        ]);

        User::create([
            'first_name' => $request['firstName'],
            'last_name' => $request['lastName'],
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'type' => User::NOMINEE,
        ]);
        return redirect()->back();
    }

    public function deleteUser(Request $request)
    {
        $user = User::find($request->userId);
        $user->delete();
    }

    public function changeQuarter(Request $request)
    {
        $active = $request->active === 'true' ? 1 : 0;
        Quarter::where('active', 1)
                ->update(['active' => 0]);
        $quarter = Quarter::find($request->quarter)
                    ->update(['active' => $active]);
        return response()->json([
            'success' => 'true'
        ]);
    }

    public function turnVote(Request $request)
    {
        $status = $request->id === "0" ? 1 : 0;
        $nominationOpen = VoteStatus::all()->pluck('nominationOpen')->first();
        if ($nominationOpen === 1) {
            return response()->json(['success' => 'false']);
        } else {
            VoteStatus::where('votingOpen', $request->id)
                ->update(['votingOpen' => $status]);
            return response()->json([
                'success' => 'true'
            ]);
        }

    }

    public function turnNomination()
    {
        $status = request()->id === "0" ? 1 : 0;
        $votingOpen = VoteStatus::all()->pluck('votingOpen')->first();
        if ($votingOpen === 1) {
            return response()->json(["success" => 'false']);
        } else {
            VoteStatus::where('nominationOpen', request()->id)
                ->update(['nominationOpen' => $status]);
            return response()->json([
                'success' => 'true'
            ]);
        }
    }

    public function tieBreaker()
    {
        $valueCreatorTie = self::nomineeTieBreaker(1);
        $peopleDeveloperTie = self::nomineeTieBreaker(2);
        $businessOperatorTie = self::nomineeTieBreaker(3);
        $valueCreatorExplanations = DB::select('select * from nominations left join explanations on nominations.id = explanations.nomination_id where year(nominations.created_at) = ? and category = 1 and quarter = ? and explanation is not null', [now()->year, $this->quarter]);
        $valueCreatorExplanations = self::sortExplanationToUsers($valueCreatorExplanations);
        $peopleDeveloperExplanations = DB::select('select * from nominations left join explanations on nominations.id = explanations.nomination_id where year(nominations.created_at) = ? and category = 2 and quarter = ? and explanation is not null', [now()->year, $this->quarter]);
        $peopleDeveloperExplanations = self::sortExplanationToUsers($peopleDeveloperExplanations);
        $businessOperatorExplanations = DB::select('select * from nominations left join explanations on nominations.id = explanations.nomination_id where year(nominations.created_at) = ? and category = 3 and quarter = ? and explanation is not null', [now()->year, $this->quarter]);
        $businessOperatorExplanations = self::sortExplanationToUsers($businessOperatorExplanations);

        return view('tieBreaker', compact('valueCreatorTie', 'peopleDeveloperTie', 'businessOperatorTie', 'valueCreatorExplanations', 'peopleDeveloperExplanations', 'businessOperatorExplanations'));
    }

    private function nomineeTieBreaker(int $category)
    {
        return DB::select('select id, nominee, count(*) as count from votes where quarter = ? and YEAR(created_at) = ? and category = ? group by nominee having count = (select max(count) from (select count(*) as count from votes where quarter = ? and year(created_at) = ? and category = ? group by nominee ) as count)', [$this->quarter, now()->year, $category, $this->quarter, now()->year, $category]);
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
}
