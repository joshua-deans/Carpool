<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carpool;
use App\User;
use App\Driver;


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
        $user_id = auth()->user()->id;
        $driver_routes = Carpool::where('driverID',$user_id)->orderBy('carpoolDateTime')->paginate(3, ['*'], 'droutes');
        $passenger_routes = Carpool::where('passID',$user_id)->orderBy('carpoolDateTime')->paginate(3, ['*'], 'proutes');
        $users = User::all();
        return view('routes.index')->with('driver_routes',$driver_routes)
                                        ->with('passenger_routes',$passenger_routes)
                                        ->with('user_id',$user_id)
                                        ->with('users',$users);
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
        $this->validate($request, array(
            'origin' => 'required',
            'destination' => 'required',
            'time' => 'required|numeric'
        ));
        $carpool = new Carpool;
        $carpool->driverID = auth()->user()->id;
        $carpool->passID = null;
        $carpool->carpoolDateTime = $request->input('time');
        $carpool->peopleCap = 0;
        $carpool->peopleCur = 0;
        $carpool->coords = $request->input('locJSON');
        $saved = $carpool->save();

        if ($saved) {
            return redirect('/dashboard')->with('success', 'Route was created.');
        } else {
            return redirect('/dashboard')->with('error', 'Route could not be created.');
        }
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
        $passenger = User::where('id',$routes->passID)->get();
        $driver = User::where('id',$routes->driverID)->get();
        $driver_detail = Driver::where('id',$routes->driverID)->get();
        return view('routes.show')
            ->with('routes',$routes)
            ->with('passenger',$passenger)
            ->with('driver',$driver)
            ->with('driver_detail',$driver_detail);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $routes = Carpool::find($id);
        return view('routes.edit')->with('routes',$routes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $user_id = auth()->user()->id;
        $route = Carpool::find($id);
        $route->passID = $user_id;
        $saved = $route->save();
        if ($saved) {
            return redirect('/dashboard')->with('success', 'Route was successfully joined.');
        } else {
            return redirect('/dashboard')->with('error', 'Route could not be joined.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $routes = Carpool::find($id);
        $routes->delete();
        return redirect('/Routes');
    }


    public function matching(Request $request)
    {
        $time = $request->input('time');
        $coords = $request->input('locJSON');
        $routes = Carpool::where('passID',NULL)->get();
        $users = User::all();

        return view('pages.displayroute')
                ->with('p_time',$time)
                ->with('routes',$routes)
                ->with('p_coords', $coords)
                ->with('users', $users);
    }
}

