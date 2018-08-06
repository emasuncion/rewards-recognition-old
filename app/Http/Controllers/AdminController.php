<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
