<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carpool;

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
    public function index(Request $request)
    {
        //$departTime = $request->input('time');
        //$origin = $request->input('origin');
        //$dest = $request->input('destination');

        //$matchTime = Carpool::find($departTime);
        //$matchOrigin = $matchTime::find($origin);
        //$routes = $matchOrigin::find($dest)->paginate(100);
        //$routes = Carpool::orderBy('carpoolDateTime')->paginate(100);
        //$routes = Carpool::where('carpoolDateTime', $departTime)->first();
        //$routes = Carpool::orderBy('carpoolDateTime')->paginate(100);
        //return view('pages.dashboard')->with('routes',$routes);
        return view('pages.dashboard');
    }
}
