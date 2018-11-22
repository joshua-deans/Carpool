<?php

namespace App\Http\Controllers;

use App\Driver;
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
    public function index()
    {
        $user = auth()->user();
        $driver = Driver::where('id', $user->id)->count();
        $routes = Carpool::orderBy('carpoolDateTime')->paginate(2);
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
        if ($driver <= 0) {
            return view('pages.dashboard')->with('user', $user)->with('routes', $routes)->with('driver', false);
        } else {
            return view('pages.dashboard')->with('user', $user)->with('routes', $routes)->with('driver', true);
        }
    }
}
