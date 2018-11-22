<?php

namespace App\Http\Controllers;

use App\Carpool;
use App\Members;
use Illuminate\Http\Request;

class AdminCarpoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carpools = Carpool::paginate(5);
        $driversArray = [];
        $passengerArray = [];

        foreach($carpools as $carpool){
            $driver = Members::find($carpool->driverID);
            $passenger = Members::find($carpool->passID);
            $driverName = $driver['name'];
            $passName = $passenger['name'];
            $driversArray[$carpool->driverID] = $driverName;
            $passengerArray[$carpool->passID] = $passName;
        }

        return view('admin.manage-carpool')->with('carpools', $carpools)
                                                ->with('driverNames', $driversArray)
                                                ->with('passengerNames', $passengerArray);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carpools = Carpool::find($id);
        $carpools->delete();
        return redirect('/carpools');
    }
}
