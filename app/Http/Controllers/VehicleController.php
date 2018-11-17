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
        $vehicleId = $user->vehicleId;
        $vehicle = Vehicle::find($vehicleId);
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

}
