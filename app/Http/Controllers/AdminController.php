<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $employees = User::where('active', 1)
                    ->orderBy('name', 'asc')
                    ->get();
        return view('settings', ['employees' => $employees]);
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
            'success' => 'false'
        ]);
    }

    public function reset(Request $request)
    {
        $reset = Employee::where('voted', 1)->update(['voted' => 0]);
        return response()->json([
            'success' => 'true'
        ]);
    }
}
