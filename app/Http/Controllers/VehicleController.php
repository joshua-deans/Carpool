<?php

namespace App\Http\Controllers;

use App\Vehicle;
use Illuminate\Http\Request;
use App\Carpool;
use App\User;
use Image;


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
            'model' => 'required',
            'seats' => 'required|integer|max:10',
            'year' => 'integer|max:2020'
        ));
        $user = auth()->user();
        $vehicle = new Vehicle();
        $vehicle->name= $request->input('name');
        $vehicle->make= $request->input('make');
        $vehicle->model= $request->input('model');
        $vehicle->color= $request->input('color');
        $vehicle->year= $request->input('year');
        $vehicle->seats= $request->input('seats');
        $vehicle->description = $request->input('description');

        if($request->hasFile('picture')){
            $image= $request->file('picture');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(200, 200)->save( public_path('images/' . $filename ) );
            $vehicle->picture= $filename;
        };

        $vehicle->ownerId = $user->id;
        $vehicle->save();
        $user->vehicleId = $vehicle->id;
        $user->save();
        return redirect('/vehicle')->with('vehicle', $vehicle);
    }

    public function edit(Request $request){
        $user = auth()->user();
        $vehicleId = $user->vehicleId;
        $vehicle = Vehicle::find($vehicleId);
        return view('vehicle.edit')->with('vehicle', $vehicle);
    }

    public function editVehicle(Request $request){
        $this->validate($request, array(
            'name' => 'required',
            'make' => 'required',
            'model' => 'required',
            'seats' => 'required|integer|max:10',
            'year' => 'integer|max:2020'
        ));

        $user = auth()->user();
        $vehicleId = $user->vehicleId;
        $vehicle = Vehicle::find($vehicleId);
        $vehicle->name= $request->input('name');
        $vehicle->make= $request->input('make');
        $vehicle->model= $request->input('model');
        $vehicle->color= $request->input('color');
        $vehicle->year= $request->input('year');
        $vehicle->seats= $request->input('seats');
        $vehicle->description = $request->input('description');

        if($request->hasFile('picture')){
            $image= $request->file('picture');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(200, 200)->save( public_path('images/' . $filename ) );
            $vehicle->picture= $filename;
        };

        $vehicle->save();
        return redirect('/vehicle')->with('vehicle', $vehicle);
    }

}
