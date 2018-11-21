<?php

namespace App\Http\Controllers;

use App\Carpool;
use App\Members;
use App\Driver;
use Illuminate\Http\Request;


class AdminDashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Members::all();
        $drivers = Driver::all();
        $carpools = Carpool::all();

        $membersCount = sizeof($members);
        $driversCount = sizeof($drivers);
        $carpoolsCount = sizeof($carpools);

        $systemArray = ['members' => $membersCount, 'drivers' => $driversCount, 'carpools' => $carpoolsCount];
        return view('pages.admin-dashboard')->with('systemData', $systemArray);
    }
}
