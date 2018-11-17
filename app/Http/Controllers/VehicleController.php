<?php

namespace App\Http\Controllers;

use App\Vehicle;
use Illuminate\Http\Request;
use App\Carpool;
use App\User;


class VehicleController extends Controller
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
        $user = auth()->user();
        $vehicle = $user->vehicleId;
        return view('vehicle.index')->with('vehicle',$vehicle);
    }

    public function add(Request $request){
        $this->validate($request, array(
            'name' => 'required',
            'make' => 'required',
        ));
        $user = auth()->user();
        $vehicle = new Vehicle();
        $vehicle->name= $request->input('name');
        $vehicle->make= $request->input('make');
        $vehicle->model= $request->input('model');
        $vehicle->color= $request->input('color');
        $vehicle->year= $request->input('year');
        $vehicle->seats= $request->input('seats');

        $vehicle->ownerId = $user->id;
        $vehicle->save();
        $user->vehicleId = $vehicle->id;
        $user->save();
        return view('vehicle.index')->with('vehicle', $vehicle);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
