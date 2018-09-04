<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\AwardForward;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the change password form
     * @return \Illuminate\Http\Response
     */
    public function showChangePasswordForm(){
        return view('auth.changepassword');
    }

    /**
     * Submit the change password request
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function changePassword(Request $request){

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success","Password changed successfully !");

    }

    /**
     * Show the Award it forward page
     * @return \Illuminate\Http\Response
     */
    public function awardForward()
    {
        $users = User::all()->where('type', '!=', 3);
        $nominees = AwardForward::paginate(8);
        return view('awardForward', compact('nominees', 'users'));
    }

    /**
     * Inserts new nominee to the award_forward table
     * @param Request $request
     * @return \Illuminate\Http\Request
     */
    public function awardForwardAdd(Request $request)
    {
        $award = new AwardForward;
        $award->nominee = $request->nominee;
        $award->description = $request->description;
        $award->save();
        return redirect()->back();
    }
}
