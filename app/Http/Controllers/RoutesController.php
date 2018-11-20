<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carpool;
use App\User;


class RoutesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $routes = Carpool::orderBy('carpoolDateTime')->paginate(1);
        return view('routes.index')->with('routes',$routes);
    }

    public function searchMatches()
    {
        $routes = Carpool::all();
        return response()->json(array('routes' => $routes));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $carpool = new Carpool;
        $carpool->driverID = auth()->user()->id;
        $carpool->passID = null;
        $carpool->carpoolDateTime = $request->input('time');
        $carpool->peopleCap = 0;
        $carpool->peopleCur = 0;
        $carpool->coords = $request->input('locJSON');
        $carpool->save();

        return redirect('/dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $routes = Carpool::find($id);
        $passenger = User::find($routes->passID);
        $driver = User::find($routes->driverID);
        return view('routes.show')
            ->with('routes',$routes)
            ->with('passenger',$passenger)
            ->with('driver',$driver);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
