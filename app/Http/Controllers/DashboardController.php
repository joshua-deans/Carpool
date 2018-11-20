<?php

namespace App\Http\Controllers;

use App\Driver;
use Illuminate\Http\Request;

class DashboardController extends Controller
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
        $user = auth()->user();
        $driver = Driver::where('id', $user->id)->count();
        if ($driver <= 0) {
            return view('pages.dashboard')->with('user', $user)->with('driver', false);
        } else {
            return view('pages.dashboard')->with('user', $user)->with('driver', true);
        }
    }
}
