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
    public function index()
    {
        //return view('pages.dashboard');
        $routes = Carpool::orderBy('carpoolDateTime')->paginate(2);
        return view('pages.dashboard')->with('routes',$routes);
    }
}
