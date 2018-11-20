<?php

namespace App\Http\Controllers;

use App\Vehicle;
use App\Driver;
use Illuminate\Http\Request;
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
        $vehicleId = $user->id;
        $driver = Driver::find($vehicleId);
        return view('vehicle.index')->with('vehicle',$driver);
    }

    public function add(Request $request){
        $this->validate($request, array(
            'vehicleName' => 'required',
            'make' => 'required',
            'model' => 'required',
            'seats' => 'required|integer|max:10',
            'year' => 'integer|max:2020'
        ));
        $user = auth()->user();
        $driver = new Driver();
        $driver->id = $user->id;
        $driver->vehicleName= $request->input('vehicleName');
        $driver->make= $request->input('make');
        $driver->licenseStatus = $request->input('licenseStatus');
        $driver->model= $request->input('model');
        $driver->color= $request->input('color');
        $driver->year= $request->input('year');
        $driver->seats= $request->input('seats');
        $driver->description = $request->input('description');

        if($request->hasFile('picture')){
            $image= $request->file('picture');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(200, 200)->save( public_path('images/' . $filename ) );
            $driver->picture= $filename;
        };

//        $vehicle->ownerId = $user->id;
        $driver->save();
//        $user->vehicleId = $vehicle->id;
//        $user->save();
        return redirect('/vehicle')->with('vehicle', $driver);
    }

    public function edit(Request $request){
        $user = auth()->user();
        $vehicleId = $user->id;
        $driver = Driver::find($vehicleId);
        return view('vehicle.edit')->with('vehicle', $driver);
    }

    public function editVehicle(Request $request){
        $this->validate($request, array(
            'vehicleName' => 'required',
            'make' => 'required',
            'model' => 'required',
            'seats' => 'required|integer|max:10',
            'year' => 'integer|max:2020'
        ));
        $user = auth()->user();
        $driver = Driver::find($user->id);
        $driver->id = $user->id;
        $driver->vehicleName = $request->input('vehicleName');
        $driver->make = $request->input('make');
        $driver->licenseStatus = $request->input('licenseStatus');
        $driver->model = $request->input('model');
        $driver->color = $request->input('color');
        $driver->year = $request->input('year');
        $driver->seats = $request->input('seats');
        $driver->description = $request->input('description');

        if($request->hasFile('picture')){
            $image= $request->file('picture');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(200, 200)->save( public_path('images/' . $filename ) );
            $driver->picture= $filename;
        };

//        $vehicle->ownerId = $user->id;
        $driver->save();
        return redirect('/vehicle')->with('vehicle', $driver);
    }

}
