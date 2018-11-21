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
        if ($driver <= 0) {
            return view('pages.dashboard')->with('user', $user)->with('routes',$routes)->with('driver', false);
        } else {
            return view('pages.dashboard')->with('user', $user)->with('routes',$routes)->with('driver', true);
        }
    }
}
