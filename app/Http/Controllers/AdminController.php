<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Nominate;
use App\User;
use App\Employee;

class AdminController extends Controller
{
    /**
     * Create a new Admin controller instance
     */
    public function __construct()
    {
        $this->middleware('auth');
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
        return view('settings', compact('users'));
    }

    public function turnOn(Request $request)
    {
        $nomination = Nominate::where('isvotingOpen', 0)->update(['isvotingOpen' => $request->isvotingOpen]);
        return response()->json([
            'success' => 'true'
        ]);
    }

    public function turnOff(Request $request)
    {
        $nomination = Nominate::where('isvotingOpen', 1)->update(['isvotingOpen' => $request->isvotingOpen]);
        return response()->json([
            'success' => 'true'
        ]);
    }

    public function reset(Request $request)
    {
        $reset = Employee::where('voted', 1)->update(['voted' => 0]);
        return response()->json([
            'success' => 'true'
        ]);
    }

    public function changeRole(Request $request)
    {
        $isAdmin = $request->isAdmin === 'true' ? 'admin' : 'default';
        User::where('name', $request->employee)->update(['type' => $isAdmin]);
        return response()->json([
            'success' => 'true'
        ]);
    }

    public function addMember(Request $request)
    {
         $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|indisposable|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'type' => User::DEFAULT_TYPE,
        ]);
        return redirect()->back();
    }
}
